<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use \kartik\switchinput\SwitchInput;
?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><div class="row"><div class="col-lg-6"><h4><?= Yii::t('frontend','Dates &amp; Times') ?></h4></div><div class="col-lg-6" ><div style="float:right;"><?= Html::a(Yii::t('frontend', ''), ['meeting-time/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary  glyphicon glyphicon-plus']) ?></div></div></div></div>

  <!-- Table -->
  <table class="table">
     <thead>
     <tr class="small-header">
       <td></td>
       <td >You</td>
       <td >Them</td>
       <td >Choose</td>
    </tr>
    </thead>
    <?= ListView::widget([ 
           'dataProvider' => $timeProvider, 
           'itemOptions' => ['class' => 'item'], 
           'layout' => '{items}',
           'itemView' => '_list', 
       ]) ?>
  </table>
  
</div>
 <?
  echo SwitchInput::widget([
      'name' => 'sites',
      'type' => SwitchInput::RADIO,
      'items' => [
          [ 'value' => 2, ],
      ],
      'pluginOptions' => ['size' => 'mini','handleWidth'=>60,'onText'=> Yii::t('frontend','selected'),'offText'=> Yii::t('frontend','no'),],
      'labelOptions' => ['style' => 'font-size: 12px'],
  ]);
  echo SwitchInput::widget([
      'name' => 'sites',
      'type' => SwitchInput::RADIO,
      'items' => [
          [ 'value' => 1, ],
      ],
      'pluginOptions' => ['size' => 'mini','handleWidth'=>60,'onText'=> Yii::t('frontend','selected'),'offText'=> Yii::t('frontend','no'),],
      'labelOptions' => ['style' => 'font-size: 12px'],
  ]);
  ?>
  <?
  echo SwitchInput::widget([
    'name' => 'status_3',
    'value' => 7,      
      'pluginOptions' => ['size' => 'mini','onText'=> Yii::t('frontend','yes'),'offText'=> Yii::t('frontend','no')],
  ]);
  ?>
<?php

$script = <<< JS
  
$('input[name="sites"]').on('switchChange.bootstrapSwitch', function(e, s) {
//  console.log(e.target.value); // true | false
$.ajax({
   url: '/mp/meeting/switch',
   data: {id: '<id>', 'val': e.target.value},
   success: function(data) {
       // process data
       alert(data);
   }
});
  
});

$('input[name="status_3"]').on('switchChange.bootstrapSwitch', function(e, s) {
  console.log(s); // true | false

  
});

  
JS;
$position = \yii\web\View::POS_READY;
$this->registerJs($script, $position);
?>
