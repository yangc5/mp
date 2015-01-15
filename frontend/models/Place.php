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
    
    public function addGeometry($model,$location) {
    		$x = json_decode($location,true);
    		reset($x);
    		$lat = current($x);
    		$lon = next($x);
        $pg = new PlaceGPS;
        $pg->place_id=$model->id;
        $pg->gps = new \yii\db\Expression("GeomFromText('Point(".$lat." ".$lon.")')");
        $pg->save();    
        var_dump($pg->getErrors());
        die();
    }
    
}
