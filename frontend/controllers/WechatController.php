<?php
namespace frontend\controllers;

use EasyWeChat\Foundation\Application;
use yii\web\Controller;


class WechatController extends Controller{
    public $enableCsrfValidation=false;
    //url 用于接收微信服务器的请求
    public function actionIndex()
    {
//        echo 'wechat-index';
        $app = new Application(\Yii::$app->params['wechat']);
        $response = $app->server->serve();
// 将响应输出
        $response->send(); // Laravel 里请使用：return $response;
    }
    public function actionSetmenu()
    {

    }
}