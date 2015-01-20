<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    // available languages
    // 'ar','de','es','it','iw','ja','yi','zh-CN'
    'language' => 'en', // english
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],        
    ],
];
