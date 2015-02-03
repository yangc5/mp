<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\MeetingTime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meeting-time-form">

  <div class="row">
    <div class="col-md-4">
    <?php $form = ActiveForm::begin(); ?>

    <?= DateTimePicker::widget([
        'model' => $model,
        'attribute' => 'start',
        'language' => 'en',
        'size' => 'ms',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'MM dd, yyyy HH:ii P',
            'todayBtn' => true,
            'minuteStep'=> 15, 
            'pickerPosition' => 'bottom-left',
            // to do - format one day ahead
            //'startDate'=> "2013-02-14 10:00",
            //'initialDate'=> time(),            
        ]
    ]);?>   
    </div>
  </div>  
  <div class="clearfix"><p></div>
  <div class="row">
      <div class="col-md-4">
     <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Add') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>
  </div>
    <?php ActiveForm::end(); ?>

</div>
