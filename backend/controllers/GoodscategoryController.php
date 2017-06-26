<?php

namespace backend\controllers;

use backend\models\Goodscategory;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Request;

class GoodscategoryController extends RoootController
{

    public function actionIndex()
    {
        $goodss=Goodscategory::find()->orderBy('tree','lft')->all();
        return $this->render('index',['goodss'=>$goodss]);
    }
    public function actionAdd()
    {
        $model=new Goodscategory();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->parent_id)
            {
                //添加一级分类
                $parent=Goodscategory::findOne(['id'=>$model->parent_id]);//获取上一级分类
                $model->prependTo($parent);//添加上一级分类下面
            }else{
                $model->makeRoot();
            }
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['goodscategory/index']);
        }
        //获取所有分类
        $categories=ArrayHelper::merge([['id'=>0,'name'=>'顶级分类',
                'parent_id'=>0]],Goodscategory::find()->asArray()->all());

        return $this->render('add',['model'=>$model,'categories'=>$categories]);
    }


    public function actionEdit($id)
    {
        $model=Goodscategory::findOne(['id'=>$id]);
        if ($model==null){
            throw new NotFoundHttpException('分类不存在');
        }
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->parent_id)
            {
                //添加一级分类
                $parent=Goodscategory::findOne(['id'=>$model->parent_id]);//获取上一级分类
                $model->prependTo($parent);//添加上一级分类下面
            }else{
                $model->makeRoot();
            }
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['goodscategory/index']);
        }
        //获取所有分类
        $categories=ArrayHelper::merge([['id'=>0,'name'=>'顶级分类',
            'parent_id'=>0]],Goodscategory::find()->asArray()->all());

        return $this->render('add',['model'=>$model,'categories'=>$categories]);
    }
    public function actionDelete($id)
    {
        Goodscategory::findOne(['id'=>$id])->delete();
        return $this->redirect('index');
    }
}
