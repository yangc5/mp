<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "place_gps".
 *
 * @property integer $id
 * @property integer $place_id
 * @property string $gps
 */
class PlaceGPS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_gps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'gps'], 'required'],
            [['place_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place_id' => 'Place ID',
            'gps' => 'Gps',
        ];
    }
}
