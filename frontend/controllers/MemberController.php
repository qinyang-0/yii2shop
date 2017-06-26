<?php

namespace frontend\controllers;

use frontend\models\LoginForm;
use frontend\models\Member;
use yii\web\Request;
use yii\web\User;

class MemberController extends \yii\web\Controller
{
    public $layout='login';

    public function actionAdd()
    {


        $model=new Member();
        $request=new Request();
//        var_dump($model->logo);exit;

        if ($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->password_hash = \Yii::$app->security->generatePasswordHash($model->password);

                $model->save(false);
//                \Yii::$app->session->setFlash( 'success','注册成功');
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['member/login']);
        }
        return $this->render('add',['model'=>$model]);

    }

    public function actionLogin()
    {
        $model = new LoginForm();
//        $model1=new User();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
//            var_dump($model->login());exit;
            if ($model->login()) {

                \Yii::$app->session->setFlash('success', '登陆成功');
                return $this->redirect(['xxxx/index']);
            }

        }
        return$this->render('login',['model'=>$model]);
    }
    public function actionSendSms()
    {
//        echo 333;exit;
        //确保上一次发送短信间隔超过1分钟
        $tel = \Yii::$app->request->post('tel');
        if(!preg_match('/^1[34578]\d{9}$/',$tel)){
            echo '电话号码不正确';
            exit;
        }
        $code = rand(1000,9999);
        //$result = \Yii::$app->sms->setNum($tel)->setParam(['code' => $code])->send();
        $result = 1;
        if($result){
            //保存当前验证码 session  mysql  redis  不能保存到cookie
//            \Yii::$app->session->set('code',$code);
//            \Yii::$app->session->set('tel_'.$tel,$code);
            \Yii::$app->cache->set('tel_'.$tel,$code,5*60);
            echo 'success';
        }else{
            echo '发送失败';
        }
    }


}
