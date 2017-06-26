<?php

namespace backend\controllers;

use backend\components\RbacFilter;
use backend\models\Brand;
use yii\web\Controller;
use yii\web\Request;
use xj\uploadify\UploadAction;


class BrandController extends RoootController
{


    public function actionIndex()
    {
        $brands=Brand::find()->all();
        return $this->render('index',['brands'=>$brands]);
    }
    public function actionAdd()
    {

        $model=new Brand();
        $request=new Request();
        if ($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save(false);
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['brand/index']);
        }
        return $this->render('add',['model'=>$model]);
        }
        public function actionEdit($id)
        {
            $model=Brand::findOne(['id'=>$id]);
            $request=new Request();
            if ($request->isPost){
                $model->load($request->post());
                if($model->validate()){
                    $model->save(false);
                }else{
                    var_dump($model->getErrors());exit;
                }
                return $this->redirect(['brand/index']);
            }
            return $this->render('add',['model'=>$model]);
        }
        public function actionDelete($id){
            $model=Brand::findOne(['id'=>$id]);
            $model->status=-1;
            $model->save();
            return $this->redirect(['brand/index']);
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
                //'format' => [$this, 'methodName'],
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
//                'format' => function (UploadAction $action) {
//                    $fileext = $action->uploadfile->getExtension();
//                    $filehash = sha1(uniqid() . time());
//                    $p1 = substr($filehash, 0, 2);
//                    $p2 = substr($filehash, 2, 2);
//                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
//                },
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

}
