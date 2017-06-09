<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $article_category_id
 * @property integer $sort
 * @property integer $status
// * @property integer $create_time
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'intro', 'sort', 'status',], 'required'],
            [['intro'], 'string'],
            [['article_category_id', 'sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '标题',
            'intro' => '简介',
            'article_category_id' => '文章分类id',
            'sort' => '排序',
            'status' => '状态',

        ];
    }
    public function behaviors()
    {
        return [
            'time'=>[
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    self::EVENT_BEFORE_INSERT => ['create_time'],
                ]
            ]
        ];
    }
}
