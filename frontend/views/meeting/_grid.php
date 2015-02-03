<?php
  use yii\helpers\Html;
  use yii\grid\GridView;
?>
<p></p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'columns' => [
    [
      'label'=>'Description',
        'attribute' => 'meeting_type',
        'format' => 'raw',
        'value' => function ($model) {                      
                    return '<div>'.$model->getMeetingType($model->meeting_type).' '.Yii::t('frontend','Meeting').'</div>';
            },
    ],

        ['class' => 'yii\grid\ActionColumn','header'=>'Options'],
    ],
]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create {modelClass}', [
    'modelClass' => 'Meeting',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>