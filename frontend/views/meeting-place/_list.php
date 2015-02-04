<?php
use yii\helpers\Html;
use \kartik\switchinput\SwitchInput;

?>

<tr > 
  <td style >
        <?= $model->place->name ?>
  </td>
  <td style>
      <?
      echo SwitchInput::widget([
          'name' => 'status_3',
          'value' => 1,
          'pluginOptions' => ['size' => 'mini','onText' => '<i class="glyphicon glyphicon-ok"></i>','offText'=>'<i class="glyphicon glyphicon-remove"></i>','onColor' => 'success',
                 'offColor' => 'danger',],
          
      ]);
      ?>
  </td>
  <td style>
    <?
    echo SwitchInput::widget([
        'name' => 'place-choice-'.$model->id,
      'value' => 1,        
        'pluginOptions' => ['size' => 'mini','onText' => '<i class="glyphicon glyphicon-ok"></i>','offText'=>'<i class="glyphicon glyphicon-remove"></i>','onColor' => 'success',
               'offColor' => 'danger',],
    ]);
    ?>
  </td>
  <td style>
      
      <?
      if ($model->status == $model::STATUS_SELECTED) {
          $value = $model->id;
      }    else {
        $value = 0;        
      } 
      echo SwitchInput::widget([
          'name' => 'place-chooser',
          'type' => SwitchInput::RADIO,
          'items' => [
              [ 'value' => $model->id],
          ],
          'value' => $value,
          'pluginOptions' => [  'size' => 'mini','handleWidth'=>60,'onText' => '<i class="glyphicon glyphicon-ok"></i>','offText'=>'<i class="glyphicon glyphicon-remove"></i>'],
          'labelOptions' => ['style' => 'font-size: 12px'],
      ]);      
      ?>
  </td>

  </th>
</tr>
