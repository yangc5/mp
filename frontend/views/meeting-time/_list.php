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
      ]);
      ?>
  </td>
  <td style>
    <?
    echo SwitchInput::widget([
        'name' => 'status_3',
      'value' => 1,
        
        'disabled' => true
    ]);
    ?>
  </td>
  <td style>
      <?
      echo SwitchInput::widget([
          'name'=>'status_41',
          'pluginOptions'=>[
              'handleWidth'=>60,
              'onText'=> Yii::t('frontend','Select'),
              'offText'=> Yii::t('frontend','No'),
          ]
      ]);
      ?>
  </td>

  </th>
</tr>