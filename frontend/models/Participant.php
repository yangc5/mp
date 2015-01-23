<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "participant".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $participant_id
 * @property integer $invited_by
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $invitedBy
 * @property Meeting $meeting
 * @property User $participant
 */
class Participant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'participant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'participant_id', 'invited_by', 'created_at', 'updated_at'], 'required'],
            [['meeting_id', 'participant_id', 'invited_by', 'status', 'created_at', 'updated_at'], 'integer']
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
            'participant_id' => Yii::t('frontend', 'Participant ID'),
            'invited_by' => Yii::t('frontend', 'Invited By'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvitedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'invited_by']);
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
    public function getParticipant()
    {
        return $this->hasOne(User::className(), ['id' => 'participant_id']);
    }
}
