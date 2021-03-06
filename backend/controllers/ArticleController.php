<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\Articlecategory;
use backend\models\Articledetail;
use yii\web\Controller;
use yii\web\Request;

class ArticleController extends RoootController
{

    public function actionIndex()
    {
        $articles=Article::find()->all();
        return $this->render('index',['articles'=>$articles]);
    }
    public function actionAdd()
    {
        $model=new Article();
        $model1=new Articledetail();
        $model2=Articlecategory::find()->all();

        $request=new Request();
        if ($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                $model1->article_id=$model->article_category_id;
                $model1->content=$model->intro;
                $model1->save();
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['article/index']);
        }
        return $this->render('add',['model'=>$model,'model2'=>$model2]);
    }
    public function actionEdit($id)
    {
        $model=Article::findOne(['id'=>$id]);
        $model1=new Articledetail();
        $model2=Articlecategory::find()->all();

        $request=new Request();
        if ($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save();
                $model1->article_id=$model->article_category_id;
                $model1->content=$model->intro;
                $model1->save();
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['article/index']);
        }
        return $this->render('add',['model'=>$model,'model2'=>$model2]);
    }
    public function actionDelete($id)
    {
        $model=Article::findOne(['id'=>$id]);
        $model->status=-1;
        $model->save();
        return $this->redirect(['article/index']);
    }

}
