<?php
use yii\helpers\Html;
?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><div class="row"><div class="col-lg-6"><h4><?= Yii::t('frontend','People') ?></h4></div><div class="col-lg-6" ><div style="float:right;"><?= Html::a(Yii::t('frontend', ''), ['/participant/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary  glyphicon glyphicon-plus']) ?></div></div></div></div>


</div>