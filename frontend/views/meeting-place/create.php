<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\MeetingPlace */

$this->title = Yii::t('frontend', 'Add a {modelClass}', [
    'modelClass' => 'Meeting Place',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meetings'), 'url' => ['/meeting/index']];

$this->params['breadcrumbs'][] = ['label'=>$title,'url' => ['/meeting/view', 'id' => $model->meeting_id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="meeting-place-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
