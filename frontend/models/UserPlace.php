<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "user_place".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $place_id
 * @property integer $is_favorite
 * @property integer $number_meetings
 * @property integer $is_special
 * @property string $note
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Place $place
 * @property User $user
 */
class UserPlace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'place_id'], 'required'],
            [['user_id', 'place_id', 'is_favorite', 'number_meetings', 'is_special', 'status', 'created_at', 'updated_at'], 'integer'],
            [['note'], 'string', 'max' => 255]
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
            'user_id' => Yii::t('frontend', 'User ID'),
            'place_id' => Yii::t('frontend', 'Place ID'),
            'is_favorite' => Yii::t('frontend', 'Is Favorite'),
            'number_meetings' => Yii::t('frontend', 'Number Meetings'),
            'is_special' => Yii::t('frontend', 'Is Special'),
            'note' => Yii::t('frontend', 'Note'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    // add place to user place list
    public function add($user_id,$place_id) {
        // check if it exists
        if (!UserPlace::find()
            ->where( [ 'user_id' => $user_id, 'place_id' => $place_id ] )
            ->exists()) {
              // if not, add it
              $up = new UserPlace;
              $up->user_id =$user_id;
              $up->place_id=$place_id;
              $up->save();  
            }            
    }
}
