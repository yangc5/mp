<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserSetting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-setting-form">

    <?php 
    $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']]); // important         
        //echo $form->field($model, 'filename');
         ?>
    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
         'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']],
    ]);  ?>
    
    <label class="control-label">Add Attachments</label>
    <?
    /* echo FileInput::widget([
        'model' => $us,
        'attribute' => 'profile_image',
        'options' => ['multiple' => false]
    ]); */
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('frontend', 'Create') : Yii::t('frontend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
