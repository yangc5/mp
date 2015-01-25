<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Meeting */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Meeting',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meetings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="meeting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
