<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'User Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-setting-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="col-md-8"> 
    <p>
        <?= Html::a(Yii::t('frontend', 'Create {modelClass}', [
    'modelClass' => 'User Setting',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div> <!-- end col-md-8 -->
<div class="col-md-4">
  <?= \cebe\gravatar\Gravatar::widget([
      'email' => common\models\User::find()->where(['id'=>Yii::$app->user->getId()])->one()->email,
      'options' => [
          'class'=>'profile-image',
          'alt' => common\models\User::find()->where(['id'=>Yii::$app->user->getId()])->one()->username,
      ],
      'size' => 128,
  ]);
  ?>
</div> <!-- end col-md-4 -->
</div>
