<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserContact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contact_type')
            ->dropDownList(
                $model->getUserContactTypeOptions(),   
	                ['prompt'=>Yii::t('frontend','What type of contact is this?')] 
	            )->label(Yii::t('frontend','Type of Contact')) ?>

    <?= $form->field($model, 'info')->textInput(['maxlength' => 255])->label(Yii::t('frontend','Contact Information'))->hint(Yii::t('frontend','e.g. phone number, skype address, et al.')) ?>

    <?= $form->field($model, 'details')->textarea(['rows' => 6])->hint(Yii::t('frontend','Specify any additional details the person may need to reach you with this information.')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
