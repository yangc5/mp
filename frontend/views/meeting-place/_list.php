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
          'pluginOptions' => ['size' => 'mini','onText'=> Yii::t('frontend','yes'),'offText'=> Yii::t('frontend','no'),],
          
      ]);
      ?>
  </td>
  <td style>
    <?
    echo SwitchInput::widget([
        'name' => 'place-choice-'.$model->id,
      'value' => 1,        
        'pluginOptions' => ['size' => 'mini','onText'=> Yii::t('frontend','yes'),'offText'=> Yii::t('frontend','no'),],
    ]);
    ?>
  </td>
  <td style>
      <?
      echo SwitchInput::widget([
          'name' => 'place-chooser',
          'type' => SwitchInput::RADIO,
          'items' => [
              [ 'value' => $model->id, ],
          ],
          'pluginOptions' => ['size' => 'mini','handleWidth'=>60,'onText'=> Yii::t('frontend','Selected'),'offText'=> Yii::t('frontend','no'),],
          'labelOptions' => ['style' => 'font-size: 12px'],
      ]);
      
      
      ?>
  </td>

  </th>
</tr>
