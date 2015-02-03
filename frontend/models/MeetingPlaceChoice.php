<?php

namespace frontend\models;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "meeting_place_choice".
 *
 * @property integer $id
 * @property integer $meeting_place_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property MeetingPlace $meetingPlace
 */
class MeetingPlaceChoice extends \yii\db\ActiveRecord
{
  const STATUS_NO = 0;
  const STATUS_YES = 10;
  const STATUS_UNKNOWN = 20;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meeting_place_choice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_place_id', 'user_id'], 'required'],
            [['meeting_place_id', 'user_id', 'status', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'meeting_place_id' => Yii::t('frontend', 'Meeting Place ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingPlace()
    {
        return $this->hasOne(MeetingPlace::className(), ['id' => 'meeting_place_id']);
    }
    
    public function addForNewMeetingPlace($meeting_id,$suggested_by,$meeting_place_id) {
      // create new MeetingPlaceChoice for organizer and participant(s)
      // for this meeting_id and this meeting_place_id
      // first, let's add for organizer      
      $mtg = Meeting::find()->where(['id'=>$meeting_id])->one();
      $this->add($meeting_place_id,$mtg->owner_id,$suggested_by);
      // then add for participants
      foreach ($mtg->participants as $p) {
        $this->add($meeting_place_id,$p->participant_id,$suggested_by);
      }      
    }
    
    public static function add($meeting_place_id,$user_id,$suggested_by) {
      $model = new MeetingPlaceChoice();
      $model->meeting_place_id = $meeting_place_id;
      $model->user_id = $user_id;
      // set initial choice status based if they suggested it themselves
       if ($suggested_by == $user_id) {
          $model->status = self::STATUS_YES;        
        } else {
          $model->status = self::STATUS_UNKNOWN;        
        }
      $model->save();
    }
}
