<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Friend */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Friend',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Friends'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="friend-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
