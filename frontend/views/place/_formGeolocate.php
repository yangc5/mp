<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use frontend\assets\LocateAsset;
LocateAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\Place */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="preSearch" class="center">
  <p>To join Geogram communities around you, we need to know where you live:</p>
  <div class="center">
    
    <?= Html::a('Lookup', ['lookup'], ['class' => 'btn btn-success', 'onclick' => "javascript:beginSearch();return false;"]) ?> 
    
    </div>
    <br />
    <p>If you're not home or not using WiFi, enter your address by hand:</p>
    <div class="center">    
  </div>
    
  </p>
</div>

<div class="row">
  <div class="span7">
  <div id="searchArea" class="hidden">
    <div id="autolocateAlert">
    </div> <!-- end autolocateAlert -->
    <p>Searching for your current location...<span id="status">If your location isn't found after several seconds, <a href="/userlocation/update">provide your address manually</a>.</span></p>    
      <div class="center">
    <article>
    </article>  	
    <div class="form-actions hidden" id="actionBar">
      <?php
  		?>&nbsp;<?php
?>
        		<?php 

      ?>
      
  	</div> <!-- end action Bar-->
	  </div> <!-- end center -->
  </div>   <!-- end searchArea -->
  </div> <!-- end span7 -->
	</div> <!-- end row -->