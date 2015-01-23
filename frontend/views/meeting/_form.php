<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Meeting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meeting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'meeting_type')
            ->dropDownList(
                $model->getMeetingTypeOptions(),   
                ['prompt'=>Yii::t('frontend','What type of meeting is this?')] 
            )->label(Yii::t('frontend','Meeting Type')) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6])->label(Yii::t('frontend','Personal Message')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
