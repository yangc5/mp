<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserSetting */

$this->title = Yii::t('frontend', 'Update {modelClass}', [
    'modelClass' => 'Your Settings',
]);
$this->params['breadcrumbs'][] = Yii::t('frontend', 'User Settings');
?>
<div class="user-setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
