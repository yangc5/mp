<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserPlace */

$this->title = Yii::t('frontend', 'Create {modelClass}', [
    'modelClass' => 'User Place',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'User Places'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-place-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
