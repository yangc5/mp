<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserContact */

$this->title = Yii::t('frontend', 'Add {modelClass}', [
    'modelClass' => 'Your Contact Information',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Contact Information'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-contact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
