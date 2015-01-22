<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveQuery;

class PlaceQuery extends ActiveQuery
{
    public function belongsTo($user_id = 0)
        {
            $this->joinWith('{{%user_place}}');
            return $this;
        }
}
?>