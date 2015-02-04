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
                    return '<div>'.$model->getMeetingHeader().'</div>';
            },
    ],
    [
      'label'=>'Last updated',
        'attribute' => 'updated_at',
        'format' => 'raw',
        'value' => function ($model) {                      
                    return '<div>'.Yii::$app->formatter->asDatetime($model->updated_at,"MMM d").'</div>';
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