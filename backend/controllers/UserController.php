<?php

namespace backend\controllers;

use backend\components\RbacFilter;
use backend\models\Brand;
use backend\models\LoginForm;
use backend\models\User;
use yii\web\Controller;
use yii\web\Request;
use xj\uploadify\UploadAction;


class UserController extends Controller
{
//    public function behaviors()
//    {
//        return [
//            'rbac'=>[
//                'class'=>RbacFilter::className(),
//            ]
//        ];
//    }

    public function actionIndex()
    {
//        var_dump(\Yii::$app->user->identity);
        $users=User::find()->all();
        return $this->render('index',['users'=>$users]);
    }
    public function actionAdd()
    {


        $model=new User();
        $request=new Request();
//        var_dump($model->logo);exit;

        if ($request->isPost){
            $model->load($request->post());
            if($model->validate()){
//                $model->login_time=time();
                $model->pwd = \Yii::$app->security->generatePasswordHash($model->pwd);
//                $model->login_ip=$_SERVER["REMOTE_ADDR"];
                $model->save(false);
//                                var_dump($model->login_time);exit;
                $authManager=\Yii::$app->authManager;
//                var_dump($model->roles);exit;
//                foreach ($model->roles as $role){

                $authManager->assign($authManager->getRole($model->roles),$model->id);
//            }
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['user/index']);
        }
        return $this->render('add',['model'=>$model]);

    }
    public function actionEdit($id)
    {

        $model=User::findOne(['id'=>$id]);
        $request=new Request();
        if ($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save(false);
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['user/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDelete($id){
        $model=User::findOne(['id'=>$id]);
        $model->delete();
        return $this->redirect(['user/index']);
    }
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@webroot/upload',
                'baseUrl' => '@web/upload',
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filehash = sha1(uniqid() . time());
                    $p1 = substr($filehash, 0, 2);
                    $p2 = substr($filehash, 2, 2);
                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'gif','png'],
                    'maxSize' => 5 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $imgUrl=$action->getWebUrl();
                    //$action->output['fileUrl']=$action->getWebUrl();
                    $qiniu=\Yii::$app->qiniu;
                    $qiniu->uploadFile(\yii::getAlias('@webroot').$imgUrl,$imgUrl );
                    $url=$qiniu->getLink($imgUrl);
                    $action->output['fileUrl']=$url;
                },
            ],
        ];
    }
    public function actionLogin()
    {
        $model=new LoginForm();
//        $model1=new User();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()){
//            var_dump($model->login());exit;
            if ($model->login()){

            \Yii::$app->session->setFlash('success','登陆成功');
            return $this->redirect(['user/index']);
        }

    }
        return$this->render('login',['model'=>$model]);
}
    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect(['user/login']);
    }
//    public function behaviors()
//    {
//        return [
//            'rbac'=>[
//                'class'=>RbacFilter::className(),
//                'only'=>['add','index'],
//
//            ]
//        ];
//    }

}
