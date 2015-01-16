<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Place */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="place-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <? //= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'full_address')->textInput(['maxlength' => 255])->label('Address') ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 255]) ?>

    <?// = $form->field($model, 'vicinity')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'place_type')
            ->dropDownList(
                $model->getPlaceTypeOptions(),   
                ['prompt'=>'What type of place is this?'] 
            )->label('Type of Place') ?>
            
    <?= $form->field($model, 'notes')->textArea() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
