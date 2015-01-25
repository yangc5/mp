<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Friend */

$this->title = Yii::t('frontend', 'Add a {modelClass}', [
    'modelClass' => 'Friend',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Friends'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="friend-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
