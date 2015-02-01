<?php

namespace frontend\models;

use Yii;

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
            [['meeting_place_id', 'user_id', 'created_at', 'updated_at'], 'required'],
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
}
