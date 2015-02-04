<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "meeting_time".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $start
 * @property integer $suggested_by
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Meeting $meeting
 * @property User $suggestedBy
 */
class MeetingTime extends \yii\db\ActiveRecord
{
  const STATUS_SUGGESTED =0;
  const STATUS_SELECTED =10;
  
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meeting_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'start', 'suggested_by'], 'required'],
            [['meeting_id', 'start', 'suggested_by', 'status', 'created_at', 'updated_at'], 'integer'],
            [['start'], 'unique', 'targetAttribute' => ['start','meeting_id'], 'message'=>Yii::t('frontend','This date and time has already been suggested.')],
            
        ];
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'meeting_id' => Yii::t('frontend', 'Meeting ID'),
            'start' => Yii::t('frontend', 'Start'),
            'suggested_by' => Yii::t('frontend', 'Suggested By'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    public function afterSave($insert,$changedAttributes)
    {
        parent::afterSave($insert,$changedAttributes);
        if ($insert) {
          // if MeetingTime is added
          // add MeetingTimeChoice for owner and participants
          $mtc = new MeetingTimeChoice;
          $mtc->addForNewMeetingTime($this->meeting_id,$this->suggested_by,$this->id);
        } 
    }
    
    public function addChoices($meeting_id,$participant_id) {
      $all_times = MeetingTime::find()->where(['meeting_id'=>$meeting_id])->all();
      foreach ($all_times as $mt) {
        MeetingTimeChoice::add($mt->id,$participant_id,0);        
      }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeeting()
    {
        return $this->hasOne(Meeting::className(), ['id' => 'meeting_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'suggested_by']);
    }
    
    public function getFormattedStartTime()
    {
        // use yii\i18n\Formatter;
      
        //return asDatetime($this->start);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingTimeChoices()
    {
        return $this->hasMany(MeetingTimeChoice::className(), [ 'meeting_time_id'=>'id']);
    }
    
}
