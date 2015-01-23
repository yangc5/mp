<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserPlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Your Places');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-place-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
       <?= Html::a(Yii::t('frontend', 'Create {modelClass}', [
         'modelClass' => 'Place',
      ]), ['/place/create'], ['class' => 'btn btn-success']) ?>
      
      <?= Html::a(Yii::t('frontend','Add Current Location'), ['/place/create_geo'], ['class' => 'btn btn-success']) ?> 
      <?= Html::a(Yii::t('frontend','Add a Google {modelClass}',[
         'modelClass' => 'Place'
      ]), ['/place/create_place_google'], ['class' => 'btn btn-success']) ?> 
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'place_name',
                'format' => 'raw',
                'value' => function ($model) {                      
                            return '<div>'.$model->place->name.'</div>';
                    },
            ],
            [
                'attribute' => 'place_type',
                'format' => 'raw',
                'value' => function ($model) {                      
                            return '<div>'.$model->place->getPlaceType($model->place->place_type).'</div>';
                    },
            ],
            ['class' => 'yii\grid\ActionColumn',
				      'template'=>'{view} {update} ',
					    'buttons'=>[
                'view' => function ($url, $model) {     
                  return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Yii::getAlias('@web').'/place/'.$model->place->slug, ['title' => Yii::t('yii', 'View'),]);	
						      },
                 'update' => function ($url, $model) {     
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::getAlias('@web').'/place/update/'.$model->place_id, ['title' => Yii::t('yii', 'Update'),]);	
  						    }
							],
			      ],
        ],
    ]); ?>

</div>
