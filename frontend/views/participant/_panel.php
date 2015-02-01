<?php
use yii\helpers\Html;
use yii\widgets\ListView;
?>
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><div class="row"><div class="col-lg-6"><h4><?= Yii::t('frontend','People') ?></h4></div><div class="col-lg-6" ><div style="float:right;"><?= Html::a(Yii::t('frontend', ''), ['/participant/create', 'meeting_id' => $model->id], ['class' => 'btn btn-primary  glyphicon glyphicon-plus'.((!empty($participantProvider) and ($participantProvider->getCount()>0))?' disabled':'')]) ?></div></div></div></div>
    <?php
    if (!empty($participantProvider) and $participantProvider->getCount()>0): 
    ?>
    <table class="table">
      <?= ListView::widget([ 
             'dataProvider' => $participantProvider, 
             'itemOptions' => ['class' => 'item'], 
             'layout' => '{items}',
             'itemView' => '_list', 
         ]) ?>
    </table>

    <?php else: ?>
    <?php endif; ?>

</div>