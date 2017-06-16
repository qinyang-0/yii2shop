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
 }