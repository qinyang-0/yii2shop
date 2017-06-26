<?php
namespace backend\models;

 use yii\base\Model;

 class LoginForm extends Model
 {
     public $name;
     public $pwd;
     public $remember;

     public function rules()
     {
         return [
             [['name','pwd'],'required'],
             ['remember','boolean']
         ];
     }
     public function attributeLabels()
     {
         return [
             'name'=>'用户名',
             'pwd'=>'密码',
             'remember'=>'记住我',
         ];
     }
     public function login()
     {
         $user=User::findOne(['name'=>$this->name]);
         if ($user){
//             var_dump($user->pwd);exit;
             if(\Yii::$app->security->validatePassword($this->pwd,$user->pwd)){
                 //登陆

                 $user->login_time=time();
                 $user->login_ip=$_SERVER["REMOTE_ADDR"];
                 $user->save(false);
                 //自动登陆
                 $duration=$this->remember?7*24*3600:0;
                 //用户登陆认证
                 \Yii::$app->user->login($user,3333);
                return true;
             }else{
                 $this->addError('pwd','密码不正确');
             }
         }else{
             $this->addError('name','没有该用户');

         }
         return false;
     }
 }