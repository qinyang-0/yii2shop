<?php
namespace frontend\controllers;
use backend\models\Goods;
use backend\models\Goodscategory;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;

class IndexController extends Controller{
    public $layout='index';
    public function actionIndex()
    {

        return $this->render('index');
    }
    public function actionList($cate_id)
    {
        $lists = Goodscategory::findAll(['parent_id'=>$cate_id]);
//        var_dump($lists);exit;
        $goodss=Goods::findAll(['goods_category_id'=>$cate_id]);
        $p=Goodscategory::findOne(['id'=>$cate_id]);
        $p_name=$p->name;
//        var_dump($goodss);exit;

        return $this->render('list',['lists'=>$lists,'goodss'=>$goodss,'p_name'=>$p_name]);
    }
    public function actionGoods($cate_id)
    {
        $goods= Goods::findOne(['id'=>$cate_id]);
//        var_dump($goods);exit;


        return $this->render('goods',['goods'=>$goods]);
    }



    public function actionAdd()
    {
        $goods_id=\Yii::$app->request->post('goods_id');
        $amount=\Yii::$app->request->post('amount');
        $goods=Goods::findOne(['id'=>$goods_id]);
       if ($goods==null){
           throw new NotFoundHttpException('商品不存在');
       }
       if (\Yii::$app->user->isGuest){
           //未登录
           //先获取cookie里的数据
           $cookies=\Yii::$app->request->cookies;
           $cookie=$cookies->get('cart');
           if($cookie==null){
                //cookie里没有数据
               $cart=[];
           }else{
               $cart=unserialize($cookie->value);
               $cart=[
                   $goods_id=> $amount,

               ];
//               var_dump($cart);
           }

           //将商品和数量存到cookie
           $cookies=\Yii::$app->response->cookies;
           //检查购物车中是否有改商品，有 ，数量累加
           if (key_exists($goods->id,$cart)){
               $cart[$goods_id]+=$amount;
           }else{
               $cart[$goods_id]=$amount;
           }
//           $cart=[
//               $goods_id=> $amount,
//
//           ];

           $cookie=new Cookie([
              'name'=>'cart','value'=>serialize($cart)
           ]);
           $cookies->add($cookie);


       }else{

       }
//        return $this->render('');
    }
    public function actionCart()
    {
        $cookies=\Yii::$app->request->cookies;
        $cookie=$cookies->get('cart');
        if ($cookie==null){
            $cart=[];
        }else{
            $cart=unserialize($cookie->value);
        }
        return $this->render('cart',[''])
        var_dump($cart);

    }
}