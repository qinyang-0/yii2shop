<?php
namespace backend\widgets;

use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Widget;

class MenuWidget extends Widget{
    //widget被实例化后执行的代码
    public function init()
    {
        parent::init();
    }

    //widgeet被调用时，需要执行的代码
    public function run()
    {
        NavBar::begin([
            'brandLabel' => '古加拉斯皮怪',
            'brandUrl' => \Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => '首页', 'url' => ['/goods/index']],
        ];
        if (\Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '登陆', 'url' => \Yii::$app->user->loginUrl];
        } else {
            $menuItems[] = ['label' => '注销('.\Yii::$app->user->identity->name.')', 'url' => \Yii::$app->user->loginUrl];
            $menuItems[]=['label' => '用户管理', 'items'=>[
                ['label'=>'添加用户','url'=>['user/add']],
                ['label'=>'用户列表','url'=>['user/index']],
            ]];
            $menuItems[]=['label' => '用户管理', 'items'=>[
                ['label'=>'添加用户','url'=>['user/add']],
                ['label'=>'用户列表','url'=>['user/index']],
            ]];
            $menuItems[]=['label' => '用户管理', 'items'=>[
                ['label'=>'添加用户','url'=>['user/add']],
                ['label'=>'用户列表','url'=>['user/index']],
            ]];
            $menuItems[]=['label' => '用户管理', 'items'=>[
                ['label'=>'添加用户','url'=>['user/add']],
                ['label'=>'用户列表','url'=>['user/index']],
            ]];
            $menuItems[]=['label' => '用户管理', 'items'=>[
                ['label'=>'添加用户','url'=>['user/add']],
                ['label'=>'用户列表','url'=>['user/index']],
            ]];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
    }
}