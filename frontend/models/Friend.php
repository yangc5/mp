<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "friend".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $friend_id
 * @property integer $status
 * @property integer $number_meetings
 * @property integer $is_favorite
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $friend
 * @property User $user
 */
class Friend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'friend_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'friend_id', 'status', 'number_meetings', 'is_favorite', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'friend_id' => Yii::t('frontend', 'Friend ID'),
            'status' => Yii::t('frontend', 'Status'),
            'number_meetings' => Yii::t('frontend', 'Number Meetings'),
            'is_favorite' => Yii::t('frontend', 'Is Favorite'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFriend()
    {
        return $this->hasOne(User::className(), ['id' => 'friend_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
