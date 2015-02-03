<?php

namespace frontend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use dosamigos\google\maps\services\GeocodingClient;

/**
 * This is the model class for table "{{%place}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $place_type
 * @property integer $status
 * @property string $google_place_id
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $slug
 * @property string $website
 * @property string $full_address
 * @property string $vicinity
 * @property text $notes
 *
 * @property MeetingPlace[] $meetingPlaces
 * @property User $createdBy
 * @property TemplatePlace[] $templatePlaces
 * @property UserPlace[] $userPlaces
 */
class Place extends \yii\db\ActiveRecord
{
    const TYPE_OTHER = 0;
    const TYPE_RESTAURANT = 10;
    const TYPE_COFFEESHOP = 20;
    const TYPE_RESIDENCE = 30;
    const TYPE_OFFICE = 40;
    const TYPE_BAR = 50;
    
    public $searchbox;
    public $location;
    public $lat;
    public $lng;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%place}}';
    }
    
    /**
     * @inheritdoc
     * @return PlaceQuery
     */
    public static function find()
    {
        return new PlaceQuery(get_called_class());
    }
    
    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert,$changedAttributes);
        if ($insert) {
          $up = new UserPlace;
          $up->add($this->created_by,$this->id);
        } 
    }
     
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'immutable' => true,
                'ensureUnique'=>true,
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }    

    /**
     * @inheritdoc
     */
     public function rules()
     {
         return [
             [['name','slug'], 'required'],
             [['place_type', 'status', 'created_by', 'created_at', 'updated_at'], 'integer'],
             [['name', 'google_place_id', 'slug', 'website', 'full_address', 'vicinity'], 'string', 'max' => 255],
             [['website'], 'url'],
             [['slug'], 'unique'],
             [['searchbox'], 'unique','targetAttribute' => 'google_place_id'],             
             [['name', 'full_address'], 'unique', 'targetAttribute' => ['name', 'full_address']],
         ];
     }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
          'id' => Yii::t('frontend', 'ID'),
           'name' => Yii::t('frontend', 'Name'),
           'place_type' => Yii::t('frontend', 'Place Type'),
           'status' => Yii::t('frontend', 'Status'),
           'google_place_id' => Yii::t('frontend', 'Google Place ID'),
           'created_by' => Yii::t('frontend', 'Created By'),
           'created_at' => Yii::t('frontend', 'Created At'),
           'updated_at' => Yii::t('frontend', 'Updated At'),
           'slug' => Yii::t('frontend', 'Slug'),
           'website' => Yii::t('frontend', 'Website'),
           'full_address' => Yii::t('frontend', 'Full Address'),
           'vicinity' => Yii::t('frontend', 'Vicinity'),
           'notes' => Yii::t('frontend', 'Notes'),
        ];
    }
    
    public static function googlePlaceSuggested($form) {
      // check if this google place already exists
      if (Place::find()->where(['google_place_id'=>$form['google_place_id']])->exists()) {
        $model = Place::find()->where(['google_place_id'=>$form['google_place_id']])->one();
        return $model->id;
      } else {
        // otherwise register a new place
        $model = new Place();
        $model->name =$form['name'];
        $model->place_type =self::TYPE_OTHER;
        $model->google_place_id = $form['google_place_id'];
        $model->website = $form['website'];
        $model->vicinity = $form['vicinity'];
        $model->full_address = $form['full_address'];
        $model->created_by = Yii::$app->user->getId();
        if ($model->validate()) {
             // all inputs are valid
             $model->save();
             // add GPS entry in PlaceGeometry
             $model->addGeometry($model,$form['location']);
             return $model->id;
        } else {
          return false;
        } 
      }        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingPlaces()
    {
        return $this->hasMany(MeetingPlace::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplatePlaces()
    {
        return $this->hasMany(TemplatePlace::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPlaces()
    {
        return $this->hasMany(UserPlace::className(), ['place_id' => 'id']);
    }

    public function getPlaceType($data) {
      $options = $this->getPlaceTypeOptions();
      return $options[$data];
    }
    
    public function getPlaceTypeOptions()
    {
      return array(
          self::TYPE_RESTAURANT => 'Restaurant',
          self::TYPE_COFFEESHOP => 'Coffeeshop',
          self::TYPE_RESIDENCE => 'Residence',
          self::TYPE_OFFICE => 'Office',
          self::TYPE_BAR => 'Bar',
            self::TYPE_OTHER => 'Other'
         );
     }		

     public function addLocationFromAddress($model,$full_address='') {
       // finds gps coordinates from full_address field if available
       if ($full_address=='') return false;
       $gc = new GeocodingClient();
       $result = $gc->lookup(array('address'=>$full_address,'components'=>1));
 			 $location = $result['results'][0]['geometry']['location'];
        if (!is_null($location)) {
   				$lat = $location['lat'];
   				$lng = $location['lng'];
          // add GPS entry in PlaceGeometry
          $this->addGeometryByPoint($model,$lat,$lng);       
        }
      }

     public function addGeometryByPoint($model,$lat,$lon) {
         $pg = new PlaceGPS;
         $pg->place_id=$model->id;
         $pg->gps = new \yii\db\Expression("GeomFromText('Point(".$lat." ".$lon.")')");
         $pg->save();    
     }
    
    public function addGeometry($model,$location) {
    		$x = json_decode($location,true);
    		reset($x);
    		$lat = current($x);
    		$lon = next($x);
        $pg = new PlaceGPS;
        $pg->place_id=$model->id;
        $pg->gps = new \yii\db\Expression("GeomFromText('Point(".$lat." ".$lon.")')");
        $pg->save();    
    }
    
    public function getLocation($place_id) {
      $sql = 'Select AsText(gps) as gps from {{%place_gps}} where place_id = '.$place_id;
      $model = PlaceGPS::findBySql($sql)->one();
      $gps = new \stdClass;
      if (is_null($model)) {
        return false;
      } else {
        list($gps->lat, $gps->lng) = $this->string_to_lat_lon($model->gps);        
      }
      return $gps;
    }
    
    public function getMap($gps) {
      $coord = new LatLng(['lat' => $gps->lat, 'lng' => $gps->lng]);
/*      $map = new Map([
          'center' => $coord,
          'zoom' => 14,
      ]);
      return $map;*/
    }
    
    public function prepareMap($id, $size='medium') {
      if ($pg===false) {
        // missing place_geometry 
        // TO DO: Fix this later
        return false;
      }
      $center = new stdClass;
      Yii::import('ext.gmap.*');
      $gMap = new EGMap();
      $gMap->setJsName('map_region');
      switch ($size) {
        case 'small':
          $gMap->width = '200';
          $gMap->height = '200';      
          $gMap->zoom = 13;
          $gMap->mapTypeControl= false;
        break;
        default:
          $gMap->width = '300';
          $gMap->height = '300';
          $gMap->zoom = 13;      
      }
      $gMap->setCenter($center->lat, $center->lon);
      $coords = PlaceGeometry::model()->string_to_coords($pg['region']);

      if (count($coords)>1) {
        $polygon = new EGMapPolygon($coords);
        $gMap->addPolygon($polygon);	            
      } else {
        // Create marker with label
        $marker = new EGMapMarkerWithLabel($center->lat,$center->lon, array('title' => 'Here!'));
        $gMap->addMarker($marker);          
      }
      return $gMap;
    }    
    
    // Geometry Helper Functions

    // takes text POINT(x,y) returns array with x and y
  	public function string_to_lat_lon($string) {
        $string = str_replace('POINT', '', $string); // remove POINT
        $string = str_replace('(', '', $string); // remove leading bracket
        $string = str_replace(')', '', $string); // remove trailing bracket
        return explode(' ', $string);
    }
  
}
