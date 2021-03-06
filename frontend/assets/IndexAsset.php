<?php
namespace frontend\assets;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/list.css',
        'style/common.css',
        'style/bottomnav.css',
        'style/footer.css',
	    'style/jqzoom.css',
        'style/goods.css',
        'style/home.css',
        'style/address.css',









    ];
    public $js = [
        //'js/jquery-1.8.3.min.js',
        'js/header.js',
        'js/list.js',
        'js/index.js',
        'js/goods.js',
        //'js/jqzoom-core.js',
        'js/home.js',

    ];
    public $depends = [
//        JqueryAsset::className(),
        'yii\web\JqueryAsset',
    ];
}