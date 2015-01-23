<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Your Places');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
         <?= Html::a(Yii::t('frontend', 'Create {modelClass}', [
           'modelClass' => 'Place',
        ]), ['create'], ['class' => 'btn btn-success']) ?>
        
        <?= Html::a(Yii::t('frontend','Add Current Location'), ['create_geo'], ['class' => 'btn btn-success']) ?> 
        <?= Html::a(Yii::t('frontend','Add a Google {modelClass}',[
           'modelClass' => 'Place'
        ]), ['create_place_google'], ['class' => 'btn btn-success']) ?> 
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'place_type',
                'format' => 'raw',
                'value' => function ($model) {                      
                            return '<div>'.$model->getPlaceType($model->place_type).'</div>';
                    },
            ],
            ['class' => 'yii\grid\ActionColumn',
				      'template'=>'{view} {update} ',
					    'buttons'=>[
                'view' => function ($url, $model) {     
                  return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',$model->slug, ['title' => Yii::t('yii', 'View'),]);	
						      }
							],
			      ],
        ],
    ]); ?>

</div>
