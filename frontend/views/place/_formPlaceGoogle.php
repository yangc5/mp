<?php

use yii\helpers\Html;
use yii\helpers\BaseHtml;
use yii\widgets\ActiveForm;

use frontend\assets\MapAsset;
MapAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\Place */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="placegoogle-form">
  <p>Type in a place or business known to Google Places:</p>

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'searchbox')->textInput(['maxlength' => 255])->label('Place') ?>
    
    <?= BaseHtml::activeHiddenInput($model, 'name'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'google_place_id'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'location'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'website'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'vicinity'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'full_address'); ?>

    
    <?php
    //lg('bl'.$bound_bl);
    //lg('tr'.$bound_tr);
    /*$this->widget('ext.gplacesautocomplete.GPlacesAutoComplete', array(
        'htmlOptions' => array ('class'=>'span5'),
         'name' => 'searchbox',
         'afterScript' => 'setupBounds('.$bound_bl.','.$bound_tr.');setupListeners();',
         'options' => array(
            'types' => array(
               'establishment'
            ),
            'componentRestrictions' => array(
               'country' => 'us',
             )
         )
      ));*/

/*
      $form->field($model, 'title')->hiddenInput();
      $form->field($model, 'ext_id')->hiddenInput();
      $form->field($model, 'ext_reference')->hiddenInput();
      $form->field($model, 'website')->hiddenInput();
      $form->field($model, 'full_address')->hiddenInput();
      $form->field($model, 'vicinity')->hiddenInput();
      */
    ?>

    <?php //echo $form->textFieldRow($model,'slug',array('class'=>'span5','maxlength'=>255)); ?>

    <? // $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

           <div id="map-canvas">
<?php
//  $gMap->renderMap();  
?>            
           </div>
