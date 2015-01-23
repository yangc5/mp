<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserPlace */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'User Place',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'User Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="user-place-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
