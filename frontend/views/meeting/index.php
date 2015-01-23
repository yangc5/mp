<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MeetingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Meetings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create {modelClass}', [
    'modelClass' => 'Meeting',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          'owner_id',
          [
              'attribute' => 'meeting_type',
              'format' => 'raw',
              'value' => function ($model) {                      
                          return '<div>'.$model->getMeetingType($model->meeting_type).'</div>';
                  },
          ],

            'meeting_type',
            'message:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
