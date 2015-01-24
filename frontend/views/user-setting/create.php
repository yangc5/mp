<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserSetting */

$this->title = Yii::t('frontend', 'Create {modelClass}', [
    'modelClass' => 'User Setting',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'User Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
