<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\MeetingLog */

$this->title = Yii::t('frontend', 'Create {modelClass}', [
    'modelClass' => 'Meeting Log',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meeting Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
