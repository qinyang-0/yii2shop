<?php

namespace backend\models;

use backend\components\RbacFilter;
use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro', 'status'], 'required'],
            [['intro'], 'string'],
            [['sort', 'status'], 'integer'],
            [['name', 'logo'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['sort'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'sort' => '排序',
            'status' => '状态',
            'imgFile'=>'添加图片'
        ];
    }
}
