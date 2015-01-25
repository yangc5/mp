<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MeetingNoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Meeting Notes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-note-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([ 
           'dataProvider' => $dataProvider, 
           'itemOptions' => ['class' => 'item'], 
           'itemView' => '_list', 
       ]) ?>

</div>
