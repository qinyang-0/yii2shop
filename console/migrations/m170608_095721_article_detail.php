<?php

use yii\db\Migration;

class m170608_095721_article_detail extends Migration
{
    public function up()
    {
        $this->createTable('article_detail', [
            'article_id' => $this->primaryKey()->comment('文章id'),
            'content' => $this->text()->notNull()->comment('简介'),
        ]);
    }

    public function down()
    {
        echo "m170608_095721_article_detail cannot be reverted.\n";

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
