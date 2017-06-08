<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'language'=>'zh-CN',
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'defaultRoute' => 'index',
    ],
];
