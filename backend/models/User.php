<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $logo
 * @property integer $login_time
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    public $repwd;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','repwd','pwd','logo',], 'required'],
            ['repwd','compare', 'compareAttribute'=>'pwd'],
            ['login_time','integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '用户名',
            'pwd' => '密码',
            'repwd' => '确认密码',
            'logo'=>'头像',

        ];
    }


}
