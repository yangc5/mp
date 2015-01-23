<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "meeting_log".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $action
 * @property integer $actor_id
 * @property integer $item_id
 * @property integer $extra_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $actor
 * @property Meeting $meeting
 */
class MeetingLog extends \yii\db\ActiveRecord
{
	const ACTION_CREATE_MEETING = 0;
	const ACTION_CANCEL_MEETING = 7;
	const ACTION_SUGGEST_PLACE = 10;
	const ACTION_SUGGEST_TIME = 20;
	const ACTION_INVITE_PARTICIPANT = 30;
	const ACTION_ADD_NOTE = 40;
//	const ACTION_ = 50;
//	const ACTION_ = 60;
	    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meeting_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'action', 'actor_id', 'item_id', 'extra_id'], 'required'],
            [['meeting_id', 'action', 'actor_id', 'item_id', 'extra_id', 'created_at', 'updated_at'], 'integer']
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
            'action' => Yii::t('frontend', 'Action'),
            'actor_id' => Yii::t('frontend', 'Actor ID'),
            'item_id' => Yii::t('frontend', 'Item ID'),
            'extra_id' => Yii::t('frontend', 'Extra ID'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActor()
    {
        return $this->hasOne(User::className(), ['id' => 'actor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeeting()
    {
        return $this->hasOne(Meeting::className(), ['id' => 'meeting_id']);
    }

    // add to log
    public function add($meeting_id,$action,$actor_id,$item_id,$extra_id=0) {
         $log = new MeetingLog;
         $log->meeting_id=$meeting_id;
         $log->action =$action;
         $log->actor_id =$actor_id;
         $log->item_id =$item_id;
         $log->extra_id =$extra_id;
         $log->save();  
    }
    

}
