<?php
/**
 * Created by PhpStorm.
 * User: 凡
 * Date: 2017/6/29
 * Time: 11:35
 */
namespace frontend\controllers;

use backend\models\Brand;
use backend\models\User;
use frontend\models\Member;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller{
    public $enableCsrfValidation = false;
    public function init()
    {
        \Yii::$app->response->format=Response::FORMAT_JSON;
        parent::init();
    }
    public function actionMember()
    {
        $request=\Yii::$app->request;
        if($request->isPost){
            $member=new Member();
            $member->username=$request->post('username');

            $member->password=$request->post('password');
            $member->password_hash = \Yii::$app->security->generatePasswordHash($member->password);

            $member->email=$request->post('email');
            $member->tel=$request->post('tel');
            $member->status=$request->post('status');
            if ($member->validate()){
                $member->save();
                return['status'=>1,'msg'=>'','data'=>$member->toArray()];
            }
            return['status'=>-1,'msg'=>$member->getErrors()];

        }
        return ['status'=>-1,'msg'=>'请使用post请求'];
    }
    public function actionEditmember()
    {
        if ($id=\Yii::$app->request->get('id')){
            $member=Member::findOne(['id'=>$id]);
            $request=\Yii::$app->request;
            if($request->isPost){

                $member->username=$request->post('username');

                $member->password=$request->post('password');
                $member->password_hash = \Yii::$app->security->generatePasswordHash($member->password);

                $member->email=$request->post('email');
                $member->tel=$request->post('tel');
                $member->status=$request->post('status');
                if ($member->validate()){
                    $member->save();
                    return['status'=>1,'msg'=>'','data'=>$member->toArray()];
                }
                return['status'=>-1,'msg'=>$member->getErrors()];

            }
            return ['status'=>-1,'msg'=>'请使用post请求'];
        }

    }
}