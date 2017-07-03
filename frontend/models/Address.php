<?php
namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $username
 * @property string $province
 * @property string $city
 * @property string $county
 * @property string $address
 * @property string $tel
 * @property integer $status
 */
class Address extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'province', 'city', 'county', 'address', 'tel'], 'required'],
            [['member_id', 'status'], 'integer'],
            [['username', 'province', 'city', 'county'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 11],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => '所属用户',
            'username' => '收货人',
            'province' => '省',
            'city' => '市',
            'county' => '县',
            'address' => '详细地址',
            'tel' => '手机号码',
            'status' => '是否默认地址',
        ];
    }
}