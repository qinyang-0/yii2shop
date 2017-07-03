<?php
/**
 * Created by PhpStorm.
 * User: 凡
 * Date: 2017/6/29
 * Time: 11:35
 */
namespace backend\controllers;

use backend\models\Brand;
use backend\models\User;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller{
    public $enableCsrfValidation = false;
    public function init()
    {
        \Yii::$app->response->format=Response::FORMAT_JSON;
        parent::init();
    }
    public function actionBrand()
    {
        $request=\Yii::$app->request;
        if($request->isPost){
            $brand=new Brand();
            $brand->name=$request->post('name');
            $brand->intro=$request->post('intro');
            $brand->sort=$request->post('sort');
            $brand->status=$request->post('status');
            if ($brand->validate()){
                $brand->save();
                return['status'=>1,'msg'=>'','data'=>$brand->toArray()];
            }
            return['status'=>-1,'msg'=>$brand->getErrors()];

        }
        return ['status'=>-1,'msg'=>'请使用post请求'];
    }
}