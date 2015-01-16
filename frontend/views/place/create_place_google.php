<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Place */

$this->title = 'Create Place from Google Places';
$this->params['breadcrumbs'][] = ['label' => 'Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_formPlaceGoogle', [
        'model' => $model,
    ]) ?>

</div>

<?

  $gpJsLink= 'http://maps.googleapis.com/maps/api/js?' . http_build_query(array(
                          'libraries' => 'places',
                          'sensor' => 'false',
                  ));
  echo $this->registerJsFile($gpJsLink);

  $options = '{"types":["establishment"],"componentRestrictions":{"country":"us"}}';
  echo $this->registerJs("(function(){
        var input = document.getElementById('place-searchbox');
        var options = $options;        
        searchbox = new google.maps.places.Autocomplete(input, options);
        setupListeners();
})();" , \yii\web\View::POS_END );
// 'setupBounds('.$bound_bl.','.$bound_tr.');
?>
