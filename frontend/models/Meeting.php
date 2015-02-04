<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\i18n\Formatter;

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
  
  const VIEWER_ORGANIZER = 0;
  const VIEWER_PARTICIPANT = 10;
  
  public $title;
  public $viewer;
  public $isReadyToSend = false;
  public $isReadyToFinalize = false;
  
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
     
     public function getMeetingHeader() {
       $str = $this->getMeetingType($this->meeting_type);
       if (count($this->participants)>0) {
         $str.=Yii::t('frontend',' with ');
         $str.=$this->participants[0]->participant->email;
       }
       return $str;
     }
     
     public function getMeetingTitle($meeting_id) {
        $meeting = Meeting::find()->where(['id' => $meeting_id])->one();
        $title = $this->getMeetingType($meeting->meeting_type);
        $title.=' Meeting';
        return $title;
     }
     
     public function reschedule($meeting_id) {
       
     }

     public function setViewer() {
       if ($this->owner_id == Yii::$app->user->getId()) {
         $this->viewer = Meeting::VIEWER_ORGANIZER;
       } else {
         $this->viewer = Meeting::VIEWER_PARTICIPANT;
       }
     }
     
     public function canSend() {
       // check if an invite can be sent
       // req: a participant, at least one place, at least one time
       if (count($this->participants)>0
        && count($this->meetingPlaces)>0
        && count($this->meetingTimes)>0
        ) {
         $this->isReadyToSend = true;
       } else {
         $this->isReadyToSend = false;
       }
       return $this->isReadyToSend;
      }

      public function canFinalize() {
        // check if meeting can be finalized by viewer
        if ($this->canSend()) {
          // organizer can always finalize
          if ($this->viewer == Meeting::VIEWER_ORGANIZER) {
            $this->isReadyToFinalize = true;
          } else {
            // viewer is a participant
            // has participant responded to one time or is there only one time
            // has participant responded to one place or is there only one place
            
          }          
        }          
        
        return $this->isReadyToFinalize;
      }     
      
      public function cancel() {
        $this->status = self::STATUS_CANCELED;
        $this->save();
      }
          
      public function prepareView() {
        $this->setViewer();
        $this->canSend();
        $this->canFinalize();
        // has invitation been sent
         if ($this->canSend()) {
           Yii::$app->session->setFlash('warning', Yii::t('frontend','This invitation has not yet been sent.'));
      }
        // to do - if sent, has invitation been opened
        // to do - if not finalized, is it within 72 hrs, 48 hrs        
      }
      
      public static function friendlyDateFromTimeString($time_str) {
        $tstamp = strtotime($time_str);
        return $this->friendlyDateFromTimeString($tstamp);
      }

       // formatting helpers
       public static function friendlyDateFromTimestamp($tstamp) {
         $margin=$tstamp-time();
         // less than a day ahead
         if ($margin>(24*3600)) {
           $date_str = Yii::$app->formatter->asDateTime($tstamp,'h:mm a');
         }   else {
           $date_str = Yii::$app->formatter->asDateTime($tstamp,'E MMM d,\' '.Yii::t('frontend','at').'\' h:mm a');         
         }
         return $date_str;
       }
      
}
