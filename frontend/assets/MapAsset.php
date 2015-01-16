<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
      'js/create_place.js',
    ];
    public $depends = [
    ];
}
