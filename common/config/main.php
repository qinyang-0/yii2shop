<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'language'=>'zh-CN',
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'defaultRoute' => 'index',
        //配置RBAC
        'authManager'=>[
            'class'=>\yii\rbac\DbManager::className(),
        ],
    ],
];
