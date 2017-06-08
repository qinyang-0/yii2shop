<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\web\Request;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
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
            $model->imgFile = UploadedFile::getInstance($model,'imgFile');
            if($model->validate()){
                //保存图片
                $fileName = '/images/brand/'.uniqid().'.'.$model->imgFile->extension;
                $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                //图片地址赋值
                $model->logo = $fileName;
                $model->save(false);
//            var_dump($model);exit;
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
                $model->imgFile = UploadedFile::getInstance($model,'imgFile');
                if($model->validate()){
                    //保存图片
                    $fileName = '/images/brand/'.uniqid().'.'.$model->imgFile->extension;
                    $model->imgFile->saveAs(\Yii::getAlias('@webroot').$fileName,false);
                    //图片地址赋值
                    $model->logo = $fileName;
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
}
