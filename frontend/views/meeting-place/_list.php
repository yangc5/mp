<?php
use yii\helpers\Html;
use yii\helpers\BaseUrl;
use \kartik\switchinput\SwitchInput;

?>

<tr > 
  <td style >
        <?= Html::a($model->place->name,BaseUrl::home().'/place/'.$model->place->slug) ?>
  </td>
  <td style>
      <?
      foreach ($model->meetingPlaceChoices as $mpc) {
        if ($mpc->user_id == $model->meeting->owner_id) {
            if ($mpc->status == $mpc::STATUS_YES)
              $value = 1;
            else
              $value =0;
              echo SwitchInput::widget([
              'type'=>SwitchInput::CHECKBOX,
              'name' => 'meeting-place-choice',
              'id'=>'mpc-'.$mpc->id,          
              'value' => $value,
              'pluginOptions' => ['size' => 'mini','onText' => '<i class="glyphicon glyphicon-ok"></i>','offText'=>'<i class="glyphicon glyphicon-remove"></i>','onColor' => 'success','offColor' => 'danger',],
              ]);          
        }
      }      
      ?>
  </td>
  <td style>
    <?
  foreach ($model->meetingPlaceChoices as $mpc) {
    if (count($model->meeting->participants)==0) break;    
    if ($mpc->user_id == $model->meeting->participants[0]->participant_id) {
        if ($mpc->status == $mpc::STATUS_YES)
          $value = 1;
        else if ($mpc->status == $mpc::STATUS_NO)
          $value =0;
        else if ($mpc->status == $mpc::STATUS_UNKNOWN)
          $value =-1;
            echo SwitchInput::widget([
          'type'=>SwitchInput::CHECKBOX,         
          'name' => 'meeting-place-choice',
          'id'=>'mpc-'.$mpc->id,          
          'tristate'=>true,
          'indeterminateValue'=>-1,
          'indeterminateToggle'=>false,
          'disabled'=>true,
          'value' => $value,
          'pluginOptions' => ['size' => 'mini','onText' => '<i class="glyphicon glyphicon-ok"></i>','offText'=>'<i class="glyphicon glyphicon-remove"></i>','onColor' => 'success','offColor' => 'danger'],
      ]);          
    }
  }
    ?>
  </td>
  <td style>
      
      <?
      if ($placeCount>1) {
        if ($model->status == $model::STATUS_SELECTED) {
            $value = $model->id;
        }    else {
          $value = 0;        
        } 
        echo SwitchInput::widget([
          'type' => SwitchInput::RADIO,
          'name' => 'place-chooser',
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
