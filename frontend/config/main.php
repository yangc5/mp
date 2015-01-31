<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [    
      'urlManager' => [
                  'class' => 'yii\web\UrlManager',
                  'enablePrettyUrl' => true,
                  'showScriptName' => 'false',
                  'rules' => [
                      'place' => 'place/index',
                      'place/index' => 'place/index',
                      'place/yours' => 'place/yours',
                      'place/create' => 'place/create',
                      'place/create_geo' => 'place/create_geo',
                      'place/create_place_google' => 'place/create_place_google',
                      'place/view/<id:\d+>' => 'place/view',  
                      'place/update/<id:\d+>' => 'place/update',  
                      'place/<slug>' => 'place/slug',
					            'defaultRoute' => '/site/index',
                  ],
              ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
