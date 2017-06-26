<?php

namespace backend\models;

use creocoder\nestedsets\NestedSetsBehavior;
use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $parent_id
 * @property integer $sort
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','parent_id'], 'required'],
            [['parent_id', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['url'], 'string', 'max' => 255],
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
            'url' => '地址/路由',
            'parent_id' => '上级菜单',
            'sort' => '排序',
        ];
    }
    public function getChildren()
    {
        return $this->hasMany(self::className(),['parent_id'=>'id']);
    }
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute'=>'tree',//必须打开（多个一级分类）

            ],
        ];
    }


}
