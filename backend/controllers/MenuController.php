<?php

namespace backend\controllers;

use backend\models\Goodscategory;
use backend\models\Menu;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MenuController extends RoootController
{

    public function actionIndex()
    {
        $menus=Menu::find()->orderBy('tree','lft')->all();
        return $this->render('index',['menus'=>$menus]);
    }
    public function actionAdd()
    {
        $model=new Menu();

//        var_dump($model->label);exit;

        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            //var_dump($model->parent_id);exit;
            if($model->parent_id)
            {
                //添加一级分类
                $parent=Menu::findOne(['id'=>$model->parent_id]);//获取上一级分类
                $model->prependTo($parent);//添加上一级分类下面
            }else{
                $model->makeRoot();
            }
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['menu/index']);
        }
        //获取所有分类
        $menus=ArrayHelper::merge([['id'=>0,'name'=>'顶级菜单', 'parent_id'=>0]],Menu::find()->asArray()->all());

        return $this->render('add',['model'=>$model,'menus'=>$menus]);
    }


    public function actionEdit($id)
    {
        $model=Menu::findOne(['id'=>$id]);
        if ($model==null){
            throw new NotFoundHttpException('菜单不存在');
        }
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            if($model->parent_id)
            {
                //添加一级分类
                $parent=Menu::findOne(['id'=>$model->parent_id]);//获取上一级分类
                $model->prependTo($parent);//添加上一级分类下面
            }else{
                $model->makeRoot();
            }
            \Yii::$app->session->setFlash('success','添加成功');
            return $this->redirect(['menu/index']);
        }
        //获取所有分类
        $menus=ArrayHelper::merge([['id'=>0,'name'=>'顶级分类',
            'parent_id'=>0]],Menu::find()->asArray()->all());

        return $this->render('add',['model'=>$model,'menus'=>$menus]);
    }
    public function actionDelete($id)
    {
        Goodscategory::findOne(['id'=>$id])->delete();
        return $this->redirect('index');
    }

}
