<?php

use yii\db\Migration;

class m170612_103815_goods extends Migration
{
    public function safeUp()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('商品名称'),
            'sn' => $this->string()->notNull()->comment('货号'),
            'logo' => $this->string(255)->comment('LOGO图片'),
            'goods_category_id' => $this->integer()->notNull()->comment('商品分类id'),
            'brand_id' => $this->integer()->notNull()->comment('品牌分类'),
            'market_price' => $this->decimal(10,2)->notNull()->comment('市场价格'),
            'shop_price'=>$this->decimal(10,2)->notNull()->comment('商品价格'),
            'stock'=>$this->integer()->notNull()->comment('库存'),
            'is_on_sale'=>$this->integer(1)->notNull()->comment('是否在售'),
            'status'=>$this->integer(1)->notNull()->comment('状态'),
            'sort'=>$this->integer()->notNull()->comment('排序'),
            'create_time'=>$this->integer()->notNull()->comment('添加时间')
        ]);
    }

    public function safeDown()
    {
        echo "m170612_103815_goods cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170612_103815_goods cannot be reverted.\n";

        return false;
    }
    */
}
