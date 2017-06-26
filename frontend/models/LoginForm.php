<?php
namespace frontend\models;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $remember;
    public $code;

    public function rules()
    {
        return [
            [['username','password'],'required'],
            ['remember','boolean']
        ];
    }
    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'remember'=>'记住我',
            'code'=>'验证码',
        ];
    }
    public function login()
    {
        $member=Member::findOne(['username'=>$this->username]);
        if ($member){
//           var_dump(\Yii::$app->security->validatePassword($this->password,$member->password_hash),$this->password,$member->password_hash);exit;
            if(\Yii::$app->security->validatePassword($this->password,$member->password_hash)){
                //登陆
                $member->last_login_time=time();
                $member->last_login_ip=$_SERVER["REMOTE_ADDR"];
                $member->save(false);
                //自动登陆
//                $duration=$this->remember?7*24*3600:0;
                //用户登陆认证
                \Yii::$app->user->login($member,333);
                return true;
            }else{
                $this->addError('password','密码不正确');
            }
        }else{
            $this->addError('username','没有该用户');

        }
        return false;
    }
}