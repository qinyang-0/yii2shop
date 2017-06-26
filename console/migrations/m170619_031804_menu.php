<?php

use yii\db\Migration;

class m170619_031804_menu extends Migration
{
    public function safeUp()
    {
        $this->createTable('menu',[
         'id'=>$this->primaryKey(),
            'label'=>$this->string(20)->notNull()->comment('名称'),
            'url'=>$this->string(255)->comment('地址/路由'),
            'parent_id'=>$this->integer()->comment('上级菜单'),
            'sort'=>$this->integer()->comment('排序')
            ]);
    }

    public function safeDown()
    {
        echo "m170619_031804_menu cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170619_031804_menu cannot be reverted.\n";

        return false;
    }
    */
}
