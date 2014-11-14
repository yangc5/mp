<?php

namespace app\common\models;

use Yii;

/**
 * This is the model class for table "{{%place}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $place_type
 * @property integer $status
 * @property string $google_place_id
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property MeetingPlace[] $meetingPlaces
 * @property User $createdBy
 * @property TemplatePlace[] $templatePlaces
 * @property UserPlace[] $userPlaces
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%place}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'google_place_id', 'created_by', 'created_at', 'updated_at'], 'required'],
            [['place_type', 'status', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'google_place_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('mp\common', 'ID'),
            'name' => Yii::t('mp\common', 'Name'),
            'place_type' => Yii::t('mp\common', 'Place Type'),
            'status' => Yii::t('mp\common', 'Status'),
            'google_place_id' => Yii::t('mp\common', 'Google Place ID'),
            'created_by' => Yii::t('mp\common', 'Created By'),
            'created_at' => Yii::t('mp\common', 'Created At'),
            'updated_at' => Yii::t('mp\common', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingPlaces()
    {
        return $this->hasMany(MeetingPlace::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplatePlaces()
    {
        return $this->hasMany(TemplatePlace::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPlaces()
    {
        return $this->hasMany(UserPlace::className(), ['place_id' => 'id']);
    }
}
