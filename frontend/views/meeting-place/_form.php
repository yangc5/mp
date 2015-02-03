<?php
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtml;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\UserPlace;

use frontend\assets\MapAsset;
MapAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\MeetingPlace */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meeting-place-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <h3>Choose one of your places</h3>
    <div class="row">
      <div class="col-md-6">
    <?= Html::activeDropDownList($model, 'place_id',
          ArrayHelper::map(UserPlace::find()->all(), 'place.id', 'place.name'),['prompt'=>Yii::t('frontend','-- select one of your places below --')] ) ?>                    
    <h3>- or -</h3>
    <h3>Choose from Google Places</h3>
      <p>Type in a place or business known to Google Places:</p>
        <?= $form->field($model, 'searchbox')->textInput(['maxlength' => 255])->label('Place') ?>
      </div>
      <div class="col-md-6">
        <div id="map-canvas">
          <article></article>
        </div>
      </div>
      </div> <!-- end row -->
        <?= BaseHtml::activeHiddenInput($model, 'name'); ?>
        <?= BaseHtml::activeHiddenInput($model, 'google_place_id'); ?>
        <?= BaseHtml::activeHiddenInput($model, 'location'); ?>
        <?= BaseHtml::activeHiddenInput($model, 'website'); ?>
        <?= BaseHtml::activeHiddenInput($model, 'vicinity'); ?>
        <?= BaseHtml::activeHiddenInput($model, 'full_address'); ?>
    <div class="clearfix"></div>
    <div class="row vertical-pad">
      <div class="form-group">      
          <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Add Place') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
