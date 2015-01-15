<?php

use yii\helpers\Html;

$this->registerJsFile('js/locate.js');
$this->registerJsFile('/js/geoPosition.js');
$this->registerJsFile('http://maps.google.com/maps/api/js?sensor=false');

/* @var $this yii\web\View */
/* @var $model frontend\models\Place */

$this->title = 'Location';
$this->params['breadcrumbs'][] = ['label' => 'Places', 'url' => ['locate']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    
    <?php echo $this->render('_formLocate'); ?>

</div>
