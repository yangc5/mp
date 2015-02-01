<?php
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    <div class="row">
      <div class="col-lg-6"><h4><?= Yii::t('frontend','Places') ?></h4></div>
      <div class="col-lg-6" ><div style="float:right;"><?= Html::a('', ['meeting-place/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary glyphicon glyphicon-plus']) ?></div>
    </div>
  </div>
  </div>

  <?php
  
   if ($placeProvider->count>0): 
  ?>
  <table class="table">
     <thead>
     <tr class="small-header">
       <td></td>
       <td>You</td>
       <td>Them</td>
       <td>Choose</td>
    </tr>
    </thead>
    <?= ListView::widget([ 
           'dataProvider' => $placeProvider, 
           'itemOptions' => ['class' => 'item'], 
           'layout' => '{items}',
           'itemView' => '_list', 
       ]) ?>
  </table>
    
  <?php else: ?>
  <?php endif; ?>

</div>

