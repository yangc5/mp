<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "meeting".
 *
 * @property integer $id
 * @property integer $owner_id
 * @property integer $meeting_type
 * @property string $message
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $owner
 * @property MeetingLog[] $meetingLogs
 * @property MeetingNote[] $meetingNotes
 * @property MeetingPlace[] $meetingPlaces
 * @property MeetingTime[] $meetingTimes
 * @property Participant[] $participants
 */
class Meeting extends \yii\db\ActiveRecord
{
  const TYPE_OTHER = 0;
  const TYPE_COFFEE = 10;
  const TYPE_BREAKFAST = 20;
  const TYPE_LUNCH = 30;
  const TYPE_PHONE = 40;
  const TYPE_VIDEO = 50;
  const TYPE_HAPPYHOUR = 60;
  const TYPE_DINNER = 70;
  const TYPE_DRINKS = 80;
  const TYPE_BRUNCH = 90;
  const TYPE_OFFICE = 100;
  
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meeting';
    }

    public function behaviors()
    {
        return [
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
            [['owner_id', 'message'], 'required'],
            [['owner_id', 'meeting_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['message'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'owner_id' => Yii::t('frontend', 'Owner ID'),
            'meeting_type' => Yii::t('frontend', 'Meeting Type'),
            'message' => Yii::t('frontend', 'Message'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingLogs()
    {
        return $this->hasMany(MeetingLog::className(), ['meeting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingNotes()
    {
        return $this->hasMany(MeetingNote::className(), ['meeting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingPlaces()
    {
        return $this->hasMany(MeetingPlace::className(), ['meeting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingTimes()
    {
        return $this->hasMany(MeetingTime::className(), ['meeting_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipants()
    {
        return $this->hasMany(Participant::className(), ['meeting_id' => 'id']);
    }
    
    public function getMeetingType($data) {
      $options = $this->getMeetingTypeOptions();
      return $options[$data];
    }
    
    public function getMeetingTypeOptions()
    {
      return array(
        self:: TYPE_OFFICE => 'Office',
        self:: TYPE_COFFEE => 'Coffee',
        self:: TYPE_BREAKFAST => 'Breakfast',
        self:: TYPE_LUNCH => 'Lunch',
        self:: TYPE_PHONE => 'Phone call',
        self:: TYPE_VIDEO => 'Video conference',
        self:: TYPE_HAPPYHOUR => 'Happy hour',
        self:: TYPE_DINNER => 'Dinner',
        self:: TYPE_DRINKS => 'Drinks',
        self:: TYPE_BRUNCH => 'Brunch',
        self:: TYPE_OTHER => 'Other',
         );
     }		
}
