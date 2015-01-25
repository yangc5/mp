<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Participant */

$this->title = Yii::t('frontend', 'Invite {modelClass}', [
    'modelClass' => 'Participant',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Meetings'), 'url' => ['/meeting/index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['/meeting/view', 'id' => $model->meeting_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'friends' => $friends,
    ]) ?>

</div>
