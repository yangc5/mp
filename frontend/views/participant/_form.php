<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Participant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="participant-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>
    
    <p>Email address:</p>
    <?php 
      // preload friends into array
      echo yii\jui\AutoComplete::widget([
          'model' => $model,
          'attribute' => 'email',
          'clientOptions' => [
          'source' => $friends,
           ],
          ]);        
    ?>
    
    <p></p>
    <!-- todo - offer drop down of friends -->

    <? // $form->field($model, 'meeting_id')->textInput() ?>

    <? // $form->field($model, 'participant_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Invite') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
