<?php
/**
 * Created by PhpStorm.
 * User: 凡
 * Date: 2017/6/11
 * Time: 14:11
 */
namespace backend\models;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

class GoodscategoryQuery extends ActiveQuery
{
    public function behaviors(){
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}