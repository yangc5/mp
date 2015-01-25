<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Meeting */

$this->title = $model->getMeetingType($model->meeting_type) .' '.Yii::t('frontend', 'Meeting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meetings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-view">

   <h1><?= Html::encode($this->title) ?></h1>
  <p>
  <?= $model->message ?>
  </p>
      
    <p>
      <?= Html::a(Yii::t('frontend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

      <?= Html::a(Yii::t('frontend', 'Invite Participant'), ['/participant/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary']) ?>
      <?= Html::a(Yii::t('frontend', 'Add Place'), ['/meeting-place/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend', 'Add Time'), ['/meeting-time/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend', 'Add Note'), ['/meeting-note/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>

        <h3><?= Yii::t('frontend','Places') ?></h3>
        <?= ListView::widget([ 
               'dataProvider' => $placeProvider, 
               'itemOptions' => ['class' => 'item'], 
               'layout' => '{items}',
               'itemView' => '../meeting-place/_list', 
           ]) ?>

        <h3><?= Yii::t('frontend','Dates &amp; Times') ?></h3>
        <?= ListView::widget([ 
               'dataProvider' => $timeProvider, 
               'itemOptions' => ['class' => 'item'], 
               'layout' => '{items}',
               'itemView' => '../meeting-time/_list', 
           ]) ?>

        <h3><?= Yii::t('frontend','Notes') ?></h3>
        <?= ListView::widget([ 
               'dataProvider' => $noteProvider, 
               'itemOptions' => ['class' => 'item'], 
               'layout' => '{items}',
               'itemView' => '../meeting-note/_list', 
           ]) ?>
</div>
