<?php
use yii\helpers\Html;
use frontend\models\Meeting;
use \kartik\switchinput\SwitchInput;
?>

<tr > 
  <td style >
        <?= Meeting::friendlyDateFromTimestamp($model->start) ?>
  </td>
  <td style>
      <?
      foreach ($model->meetingTimeChoices as $mtc) {
        if ($mtc->user_id == $model->meeting->owner_id) {
            if ($mtc->status == $mtc::STATUS_YES)
              $value = 1;
            else
              $value =0;
              echo SwitchInput::widget([
              'type' => SwitchInput::CHECKBOX,              
              'name' => 'meeting-time-choice',
              'id'=>'mtc-'.$mtc->id,
              'value' => $value,
              'pluginOptions' => ['size' => 'mini','onText' => '<i class="glyphicon glyphicon-ok"></i>','offText'=>'<i class="glyphicon glyphicon-remove"></i>','onColor' => 'success','offColor' => 'danger',],
              ]);          
        }
      }
      ?>
  </td>
  <td style>
    <?
    foreach ($model->meetingTimeChoices as $mtc) {
      if (count($model->meeting->participants)==0) break;
      if ($mtc->user_id == $model->meeting->participants[0]->participant_id) {
          if ($mtc->status == $mtc::STATUS_YES)
            $value = 1;
          else if ($mtc->status == $mtc::STATUS_NO)
            $value =0;
          else if ($mtc->status == $mtc::STATUS_UNKNOWN)
            $value =-1;
          echo SwitchInput::widget([
            'type' => SwitchInput::CHECKBOX,          
            'name' => 'meeting-time-choice',
            'id'=>'mtc-'.$mtc->id,
            'tristate'=>true,
            'indeterminateValue'=>-1,
            'indeterminateToggle'=>false,
            'disabled'=>true,
            'value' => $value,
            'pluginOptions' => ['size' => 'mini','onText' => '<i class="glyphicon glyphicon-ok"></i>','offText'=>'<i class="glyphicon glyphicon-remove"></i>','onColor' => 'success','offColor' => 'danger',],
        ]);          
      }
    }
    ?>
  </td>
  <td style>
      <?
      if ($timeCount>1) {
        if ($model->status == $model::STATUS_SELECTED) {
            $value = $model->id;
        }    else {
          $value = 0;        
        } 
        echo SwitchInput::widget([
            'type' => SwitchInput::RADIO,
            'name' => 'time-chooser',
            'items' => [
                [ 'value' => $model->id],
            ],
            'value' => $value,
            'pluginOptions' => [  'size' => 'mini','handleWidth'=>60,'onText' => '<i class="glyphicon glyphicon-ok"></i>','offText'=>'<i class="glyphicon glyphicon-remove"></i>'],
            'labelOptions' => ['style' => 'font-size: 12px'],
        ]);            
      }
      ?>
  </td>
</tr>

