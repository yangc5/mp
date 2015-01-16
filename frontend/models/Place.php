<?php

namespace frontend\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
    
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                // 'slugAttribute' => 'slug',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
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
             [['google_place_id','slug'], 'unique'],
             [['name', 'google_place_id', 'slug', 'website', 'full_address', 'vicinity'], 'string', 'max' => 255],
              [['website'], 'url'],
         ];
     }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'place_type' => 'Place Type',
            'status' => 'Status',
            'google_place_id' => 'Google Place ID',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'slug' => 'Slug',
            'website' => 'Website',
            'full_address' => 'Full Address',
            'vicinity' => 'Vicinity',
            'notes'=> 'Notes',
        ];
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
