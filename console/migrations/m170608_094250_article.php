<?php

use yii\db\Migration;

class m170608_094250_article extends Migration
{
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique()->comment('名称'),
            'intro' => $this->text()->notNull()->comment('简介'),
            'article_category_id' => $this->integer()->comment('文章分类id'),
            'sort' => $this->integer(11)->notNull()->comment('排序'),
            'status' => $this->smallInteger(2)->notNull()->comment('状态'),
            'create_time' => $this->integer(11)->notNull()->comment('创建时间'),
        ]);
    }

    public function down()
    {
        echo "m170608_094250_article cannot be reverted.\n";

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
