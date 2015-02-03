<?php
use yii\helpers\Html;
use \kartik\switchinput\SwitchInput;
?>

<tr > 
  <td style >
        <?= Yii::$app->formatter->asDatetime($model->start) ?>
  </td>
  <td style>
      <?
      echo SwitchInput::widget([
          'name' => 'status_3',
          'value' => 1,
          'pluginOptions' => ['size' => 'mini','onText'=> Yii::t('frontend','yes'),'offText'=> Yii::t('frontend','no'),'onColor' => 'success',
                 'offColor' => 'danger',],
          
      ]);
      ?>
  </td>
  <td style>
    <?
    echo SwitchInput::widget([
      'name' => 'status_3',
      'value' => 1,        
        'disabled' => true,
        'pluginOptions' => ['size' => 'mini','onText'=> Yii::t('frontend','yes'),'offText'=> Yii::t('frontend','no'),'onColor' => 'success',
               'offColor' => 'danger',],
    ]);
    ?>
  </td>
  <td style>
      <?
      echo SwitchInput::widget([
          'name' => 'time-chooser',
          'type' => SwitchInput::RADIO,
          'items' => [
              [ 'value' => $model->id  ],
          ],
          'pluginOptions' => ['state'=> ($model->status==$model::STATUS_SELECTED?true:false),'size' => 'mini','handleWidth'=>60,'onText'=> Yii::t('frontend','Selected'),'offText'=> Yii::t('frontend','no')],
          'labelOptions' => ['style' => 'font-size: 12px'],
      ]);      
      
      ?>
  </td>
  </th>
</tr>

