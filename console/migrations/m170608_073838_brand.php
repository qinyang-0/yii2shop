<?php

use yii\db\Migration;

class m170608_073838_brand extends Migration
{
    public function up()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('名称'),
            'intro' => $this->text()->notNull()->comment('简介'),
            'logo' => $this->string(255)->comment('LOGO'),
            'sort' => $this->integer(10)->unique()->comment('排序'),
            'status' => $this->smallInteger(2)->notNull()->comment('状态'),
        ]);
    }

    public function down()
    {
        echo "m170608_073838_brand cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
