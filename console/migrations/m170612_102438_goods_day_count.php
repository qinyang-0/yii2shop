<?php

use yii\db\Migration;

class m170612_102438_goods_day_count extends Migration
{
    public function safeUp()
    {
        $this->createTable('goods_day_count', [
        'day' => $this->date()->notNull()->comment('日期'),
        'count'=>$this->integer()->notNull()->comment('商品数')
     ]);
    }

    public function safeDown()
    {
        echo "m170612_102438_goods_day_count cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170612_102438_goods_day_count cannot be reverted.\n";

        return false;
    }
    */
}
