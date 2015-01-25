<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FriendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Friends');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create {modelClass}', [
    'modelClass' => 'Friend',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          [
            'label'=>'Email',
              'attribute' => 'friend_id',
              'format' => 'raw',
              'value' => function ($model) {                      
                          return '<div>'.\common\models\User::find()->where(['id'=>$model->friend_id])->one()->email.'</div>';
                  },
          ],
            'number_meetings',
            // 'is_favorite',
            //'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
