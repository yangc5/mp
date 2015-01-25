<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\MeetingTime */

$this->title = Yii::t('frontend', 'Suggest {modelClass}', [
    'modelClass' => 'Meeting Time',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meetings'), 'url' => ['/meeting/index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['/meeting/view?id='.$model->meeting_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-time-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
