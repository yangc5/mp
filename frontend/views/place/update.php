<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Place */

$this->title = Yii::t('frontend', 'Update {modelClass}: ', [
    'modelClass' => 'Place',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['slug', 'slug' => $model->slug]];
$this->params['breadcrumbs'][] = Yii::t('frontend', 'Update');
?>
<div class="place-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
