<?php
namespace frontend\widgets;

use backend\models\Goodscategory;
use yii\base\Widget;

class CategoryWidget extends Widget {
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }
    public function run()
    {
        //检测redis是否有商品分类缓存

        $categories = Goodscategory::findAll(['parent_id'=>0]);
        $category_html = $this->renderFile('@app/widgets/view/category.php',['categories'=>$categories]);

        return $category_html;
    }
}