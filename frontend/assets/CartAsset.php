<?php
namespace frontend\assets;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class CartAsset extends AssetBundle
{
    public $basePath = '@webroot';//静态资源的硬盘路径
    public $baseUrl = '@web';//静态资源的url路径

    public $css = [
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/footer.css',
        'style/cart.css',
        'style/fillin.css',
    ];
    public $js = [
        'js/jquery-1.8.3.min.js',
        'js/cart1.js',
        'js/cart2.js',

    ];
    public $depends = [
//        JqueryAsset::className(),
        'yii\web\JqueryAsset',
    ];
}