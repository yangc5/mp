<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'User Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-contact-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Create {modelClass}', [
    'modelClass' => 'User Contact',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
		        [
		            'attribute' => 'contact_type',
		            'format' => 'raw',
		            'value' => function ($model) {                      
		                        return '<div>'.$model->getUserContactType($model->contact_type).'</div>';
		                },
		        ],
            'info',
            'details:ntext',
            // 'status',
            ['class' => 'yii\grid\ActionColumn',
				      'template'=>'{update} {delete}',
			      ],
        ],
    ]); ?>

</div>
