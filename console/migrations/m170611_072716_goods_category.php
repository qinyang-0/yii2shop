<?php

use yii\db\Migration;

class m170611_072716_goods_category extends Migration
{
    public function safeUp()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'tree' => $this->integer()->notNull()->comment('树id'),
            'lft' => $this->integer()->notNull()->comment('左值'),
            'rgt' => $this->integer()->comment('右值'),
            'depth' => $this->integer()->notNull()->comment('层级'),
            'name' => $this->string(50)->notNull()->comment('名称'),
            'parent_id' => $this->integer()->notNull()->comment('上级分类id'),
            'intro'=>$this->text()->notNull()->comment('介绍')
        ]);
    }

    public function safeDown()
    {
        echo "m170611_072716_goods_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170611_072716_goods_category cannot be reverted.\n";

        return false;
    }
    */
}
