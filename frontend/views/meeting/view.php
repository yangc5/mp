<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Meeting */

$this->title = $model->getMeetingHeader();
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meetings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="meeting-view">

  <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
      <div class="row">
        <div class="col-lg-12"><h1><?= Html::encode($this->title) ?></h1></div>
      </div>  
    </div>
    <div class="panel-body">
    <?= $model->message ?>
    </div>
    <div class="panel-footer">
      <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6" >
          <div style="float:right;">
          <?= Html::a(Yii::t('frontend', 'Send'), ['finalize', 'id' => $model->id], ['class' => 'btn btn-primary '.(!$model->isReadyToSend?'disabled':'')]) ?>

          <?= Html::a(Yii::t('frontend', 'Finalize'), ['finalize', 'id' => $model->id], ['class' => 'btn btn-success '.(!$model->isReadyToFinalize?'disabled':'')]) ?>
          <?= Html::a('', ['cancel', 'id' => $model->id], ['class' => 'btn btn-primary glyphicon glyphicon-remove btn-danger','title'=>Yii::t('frontend','Cancel')]) ?>

          <?= Html::a('', ['update', 'id' => $model->id], ['class' => 'btn btn-primary glyphicon glyphicon-pencil','title'=>'Edit']) ?>
          </div>
        </div>
    </div> <!-- end row -->
    </div>
   </div>

        <?= $this->render('../participant/_panel', [
            'model'=>$model,
            'participantProvider' => $participantProvider,
        ]) ?>

        <?= $this->render('../meeting-place/_panel', [
            'model'=>$model,
            'placeProvider' => $placeProvider,
        ]) ?>       
                
        <?= $this->render('../meeting-time/_panel', [
            'model'=>$model,
            'timeProvider' => $timeProvider,
        ]) ?>

        <?= $this->render('../meeting-note/_panel', [
            'model'=>$model,
            'noteProvider' => $noteProvider,
        ]) ?>

</div>
