<?php

use yii\db\Migration;

class m170625_062654_cart extends Migration
{
    public function safeUp()
    {
        $this->createTable('cart',[
            'id'=>$this->primaryKey(),
            'goods_id'=>$this->integer()->notNull()->comment('商品id'),
            'amount'=>$this->integer()->comment('商品数量'),
            'member_id'=>$this->integer()->comment('用户id'),
        ]);
    }

    public function safeDown()
    {
        echo "m170625_062654_cart cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170625_062654_cart cannot be reverted.\n";

        return false;
    }
    */
}
