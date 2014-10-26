<?php

namespace frontend\models;

use Yii;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meeting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['owner_id', 'message', 'created_at', 'updated_at'], 'required'],
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
            'id' => 'ID',
            'owner_id' => 'Owner ID',
            'meeting_type' => 'Meeting Type',
            'message' => 'Message',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
}
