<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\Goodscategory;
use backend\models\Goodsdaycount;
use backend\models\Goodsintro;
use xj\uploadify\UploadAction;
use yii\helpers\ArrayHelper;
use yii\web\Request;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $goodss=Goods::find()->all();
        return $this->render('index',['goodss'=>$goodss]);
    }
    public function actionAdd()
    {
        $model=new Goods();
        $model2=new Goodscategory();
        $model3=Brand::find()->all();
        $model4=new Goodsintro();
//        $model5=new Goodsdaycount();
//        var_dump($model4->countent);exit;

        if ($model->load(\Yii::$app->request->post()) && $model4->load(\Yii::$app->request->post())){


            if($model->validate()){

                $model->save(false);

                $model4->goods_id=$model->id;
                if($model4->validate()){
                    $model4->save(false);

                }
//                var_dump($model4->countent);exit;
            }else{
                var_dump($model->getErrors());exit;
            }
            $day=date('Y-m-d');
            $goodscount=Goodsdaycount::findOne(['day'=>$day]);
            if($goodscount==null)
            {
                $goodscount=new Goodsdaycount();
                $goodscount->day=$day;
                $goodscount->count=0;
                $goodscount->save();
            }
            $model->sn=date('Ymd').substr('000'.($goodscount->count+1),-4,4);
            $model->save();
//            var_dump($model->id);exit;
            $model4->goods_id = $model->id;
//            var_dump($model4->goods_id);exit;

            $model4->save();
            Goodsdaycount::updateAllCounters(['count'=>1],['day'=>$day]);
            \Yii::$app->session->setFlash('seccess','商品添加成功，庆添加商品相册');
            return $this->redirect(['goods/index']);
        }
        $categories=ArrayHelper::merge([['id'=>0,'name'=>'顶级分类',
            'parent_id'=>0]],Goodscategory::find()->asArray()->all());

        return $this->render('add',['model'=>$model,'model2'=>$model2,'categories'=>$categories,'model3'=>$model3,'model4'=>$model4]);
    }
    public function actionEdit($id)
    {
        $model=Goods::findOne(['id'=>$id]);
        $request=new Request();
        if ($request->isPost){
            $model->load($request->post());
            if($model->validate()){
                $model->save(false);
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['goods/index']);
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionDelete($id)
    {
        $model=Goods::findOne(['id'=>$id]);
        $model->status=-1;
        $model->save();
        return $this->redirect(['goods/index']);
    }

    public function actions() {
        return [
            'ueditor' => [
                'class' => 'crazyfd\ueditor\Upload',
                'config'=>[
                    'uploadDir'=>date('Y/m/d')
                ]

            ],
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

}
