<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;


/**
 * This is the model class for table "meeting_note".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $posted_by
 * @property string $note
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Meeting $meeting
 * @property User $postedBy
 */
class MeetingNote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meeting_note';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'note'], 'required'],
            [['meeting_id', 'posted_by', 'status', 'created_at', 'updated_at'], 'integer'],
            [['note'], 'string']
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
            'posted_by' => Yii::t('frontend', 'Posted By'),
            'note' => Yii::t('frontend', 'Note'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
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
    public function getPostedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'posted_by']);
    }
}
