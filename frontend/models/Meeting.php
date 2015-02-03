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

  const STATUS_PLANNING =0;
  const STATUS_CONFIRMED = 20;
  const STATUS_COMPLETED = 40;
  const STATUS_CANCELED = 60;
  
  public $title;
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
	  if (!isset($options[$data])) {
		$data = self::TYPE_OTHER;
		}
      return $options[$data];
    }
    
    public function getMeetingTypeOptions()
    {
      return array(
        self::TYPE_OFFICE => 'Office',
        self::TYPE_COFFEE => 'Coffee',
        self::TYPE_BREAKFAST => 'Breakfast',
        self::TYPE_LUNCH => 'Lunch',
        self::TYPE_PHONE => 'Phone call',
        self::TYPE_VIDEO => 'Video conference',
        self::TYPE_HAPPYHOUR => 'Happy hour',
        self::TYPE_DINNER => 'Dinner',
        self::TYPE_DRINKS => 'Drinks',
        self::TYPE_BRUNCH => 'Brunch',
        self::TYPE_OTHER => 'Other',
         );
     }		
     
     public function getMeetingTitle($meeting_id) {
        $meeting = Meeting::find()->where(['id' => $meeting_id])->one();
        $title = $this->getMeetingType($meeting->meeting_type);
        $title.=' Meeting';
        return $title;
     }
     
     public function canInvite($meeting_id) {
       // check if an invite can be sent
       // is there a participant
       // is there at least one place
       // is there at least one time
       return false;
     }
     
     public function canFinalize($meeting_id) {
       // organizer can always finalize
       // check if meeting can be finalized by participant
       // is there a participant
       // has participant responded to one time or is there only one time
       // has participant responded to one place or is there only one place
       return false;
     }
     
     public function cancel($meeting_id) {
       
     }

     public function reschedule($meeting_id) {
       
     }
     
/*
     // formatting helpers
     public static function friendly_date($time_str) {
       $tstamp = strtotime($time_str);
       if (date('z',time()) <= date('z',$tstamp))
         $date_str = Yii::app()->dateFormatter->format('h:mm a',CDateTimeParser::parse($tstamp, 'yyyy-MM-dd'),'medium',null);
         else
         $date_str = Yii::app()->dateFormatter->format('MMM d',CDateTimeParser::parse($tstamp, 'yyyy-MM-dd'),'medium',null);  
       return $date_str;
     }
  */   
}
