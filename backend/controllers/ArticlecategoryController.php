<?php

namespace backend\controllers;

use backend\components\RbacFilter;
use backend\models\Articlecategory;
use yii\web\Controller;
use yii\web\Request;

class ArticlecategoryController extends RoootController
{

    public function actionIndex()
    {
        $types=Articlecategory::find()->all();
        return $this->render('index',['types'=>$types]);
    }
    public function actionAdd()
    {
        $model=new Articlecategory();
        $request=new Request();
        if ($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['articlecategory/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionEdit($id)
    {
        $model=Articlecategory::findOne(['id'=>$id]);
        $request=new Request();
        if ($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['articlecategory/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDelete($id)
    {
        Articlecategory::findOne(['id'=>$id])->delete();
        return $this->redirect(['articlecategory/index']);
    }


}
