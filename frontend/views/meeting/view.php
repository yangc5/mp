<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Meeting */

$this->title = Yii::t('frontend','Meeting ').$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meetings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('frontend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <? /*Html::a(Yii::t('frontend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('frontend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'owner_id',
            'meeting_type',
            'message:ntext',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <p>

      <?= Html::a(Yii::t('frontend', 'Invite Participant'), ['/participant/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?= Html::a(Yii::t('frontend', 'Add Place'), ['/meeting-place/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend', 'Add Time'), ['/meeting-time/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend', 'Add Note'), ['/meeting-note/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>

</div>
