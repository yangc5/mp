<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;

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
    public $email;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friend';
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
    public function rules()
    {
        return [
            [['email'], 'email'],
            [['user_id', 'friend_id'], 'required'],
            ['user_id', 'compare','compareAttribute' => 'friend_id', 'operator'=>'!=','message'=>Yii::t('frontend','You can\'t add yourself as a friend')],
            ['email', 'unique', 'targetAttribute' => ['user_id', 'friend_id'],'message' => Yii::t('frontend','You\'ve already added this friend')],            
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

    public function lookupEmail($email) {
      // lookup email address, return user_id if it exists
      if (User::find()->where(['email' => $email])->exists()) {
        return User::find()->where(['email' => $email])->one()->id;
      } else {
        // doesn't exist
        return false;
      }
    }
    
    public function addUser($email) {
      // register a user based on email
      $user = new User();
      $user->email = $email;
      $user->username = $email;
      $user->status = User::STATUS_PASSIVE;
      $user->setPassword( Yii::$app->security->generateRandomString());
      $user->generateAuthKey();
      $user->save();
      return $user->id;
    }
    
    public function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        return $result;
    }
    
    public static function getFriendList($user_id) {
      // load user's friends into email list array for autocomplete
      $friend_list = \frontend\models\Friend::find()->where(['user_id' => $user_id])->all();
      $email_list = [];
      foreach ($friend_list as $x) {
        $email_list[] = $x->friend->email;
      }
      return $email_list;      
    }
}
