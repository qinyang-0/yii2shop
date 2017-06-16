<?php

use yii\db\Migration;

class m170612_104354_goods_intro extends Migration
{
    public function safeUp()
    {
        $this->createTable('goods_intro', [
            'goods_id' => $this->integer()->notNull()->comment('商品'),
            'countent'=>$this->text()->notNull()->comment('商品描述')
        ]);
    }

    public function safeDown()
    {
        echo "m170612_104354_goods_intro cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170612_104354_goods_intro cannot be reverted.\n";

        return false;
    }
    */
}
