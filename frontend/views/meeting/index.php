<?php

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MeetingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('frontend', 'Meetings');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= $this->title ?></h1>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#upcoming" role="tab" data-toggle="tab">Upcoming</a></li>
  <li><a href="#past" role="tab" data-toggle="tab">Past</a></li>
  <li><a href="#canceled" role="tab" data-toggle="tab">Canceled</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="upcoming">
    <div class="meeting-index">
      
      <?= $this->render('_grid', [
          'dataProvider' => $upcomingProvider,
      ]) ?>

      </div> <!-- end of upcoming meetings tab -->
  </div>
  <div class="tab-pane" id="past">

    <?= $this->render('_grid', [
        'dataProvider' => $pastProvider,
    ]) ?>    
  </div> <!-- end of past meetings tab -->
  <div class="tab-pane" id="canceled">
    <?= $this->render('_grid', [
        'dataProvider' => $canceledProvider,
    ]) ?>
    
  </div> <!-- end of canceled meetings tab -->
  
</div>