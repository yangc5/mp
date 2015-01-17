<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Meeting */

$this->title = Yii::t('frontend', 'Create {modelClass}', [
    'modelClass' => 'Meeting',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meetings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
