<?php

use yii\db\Migration;

class m170608_102612_article_category extends Migration
{
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('名称'),
            'intro' => $this->text()->notNull()->comment('简介'),
            'sort' => $this->integer()->comment('排序'),
            'status' => $this->smallInteger(1)->notNull()->comment('类型'),
            'is_help' => $this->smallInteger(1)->notNull()->comment('类型'),
        ]);
    }

    public function down()
    {
        echo "m170608_102612_article_category cannot be reverted.\n";

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
