<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserSetting */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'User Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-setting-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-8">

    <p>
        <?= Html::a(Yii::t('frontend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('frontend', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('frontend', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    </div> <!-- end col-md-8 -->
    <div class="col-md-4">
      <?= '<img src="'.Yii::getAlias('@web').'/uploads/avatar/sqr_'.$model->avatar.'"/>' ?>
    </div> <!-- end col-md-4 -->

</div>
