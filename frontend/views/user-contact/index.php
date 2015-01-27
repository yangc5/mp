<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Contact Information');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-contact-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>You can add phone numbers and video conferencing addresses to share with your meeting contacts. e.g. Skype. Only add contacts that you wish to share with meeting participants.</p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('frontend', 'Add Contact Details', [
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
            // 'status',
            ['class' => 'yii\grid\ActionColumn',
				      'template'=>'{update} {delete}',
			      ],
        ],
    ]); ?>

</div>
