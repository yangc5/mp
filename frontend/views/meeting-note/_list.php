<?php

use yii\helpers\Html;

?>

<tr > 
  <td style >
    <div class="meeting-note-view">
      <div>
        <?= $model->note ?>
        </div>
        <div style="float:right;font-style:italic;">
        By: <?= $model->postedBy->email ?>
          </div>
        </div>
</td>
</tr>
  
</div>

