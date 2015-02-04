<?php
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><div class="row"><div class="col-lg-6"><h4><?= Yii::t('frontend','Dates &amp; Times') ?></h4></div><div class="col-lg-6" ><div style="float:right;"><?= Html::a(Yii::t('frontend', ''), ['meeting-time/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary  glyphicon glyphicon-plus']) ?></div></div></div></div>

  <?php
   if ($timeProvider->count>0): 
  ?>
  <!-- Table -->
  <table class="table">
     <thead>
     <tr class="small-header">
       <td></td>
       <td ><?=Yii::t('frontend','You') ?></td>
       <td ><?=Yii::t('frontend','Them') ?></td>
       <td >
         <?php
          if ($timeProvider->count>1) echo Yii::t('frontend','Choose');
         ?>
        </td>
    </tr>
    </thead>
    <?= ListView::widget([ 
           'dataProvider' => $timeProvider, 
           'itemOptions' => ['class' => 'item'], 
           'layout' => '{items}',
           'itemView' => '_list', 
           'viewParams' => ['timeCount'=>$timeProvider->count],           
       ]) ?>
  </table>
  <?php else: ?>
  <?php endif; ?>
</div>

  <?php
$script = <<< JS

$('input[name="time-chooser"]').on('switchChange.bootstrapSwitch', function(e, s) {
  console.log(e.target.value); // true | false
  $.ajax({
     url: '/mp/meetingtime/choose',   
     data: {id: $model->id, 'val': e.target.value},
     // e.target.value is selected MeetingTimeChoice model 
     success: function(data) {
       return true;
     }
  });

});

// users can say if a time is an option for them
$('input[name="meeting-time-choice"]').on('switchChange.bootstrapSwitch', function(e, s) {
  // set intval to pass via AJAX from boolean state
  if (s)
    state = 1;
  else
    state =0;  
  $.ajax({
     url: '/mp/meetingtimechoice/set',   
     data: {id: e.target.id, 'state': state},
     success: function(data) {
       return true;
     }
  });  
});
JS;
$position = \yii\web\View::POS_READY;
$this->registerJs($script, $position);
?>
