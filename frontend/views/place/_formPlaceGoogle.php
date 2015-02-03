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
<div class="col-md-6">

<div class="placegoogle-form">
  <p>Type in a place or business known to Google Places:</p>

    <?php $form = ActiveForm::begin(); ?>
    <?php echo $form->errorSummary($model);?> 
    
    <?= $form->field($model, 'searchbox')->textInput(['maxlength' => 255])->label('Place') ?>
    
    <?= BaseHtml::activeHiddenInput($model, 'name'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'google_place_id'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'location'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'website'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'vicinity'); ?>
    <?= BaseHtml::activeHiddenInput($model, 'full_address'); ?>

    <?= $form->field($model, 'place_type')
            ->dropDownList(
                $model->getPlaceTypeOptions(),   
                ['prompt'=>'What type of place is this?'] 
            )->label('Type of Place') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div> <!-- end col1 -->
<div class="col-md-6">
<div id="map-canvas">
  <article></article>
</div>
</div> <!-- end col2 -->
