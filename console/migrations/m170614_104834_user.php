<?php

use yii\db\Migration;

class m170614_104834_user extends Migration
{
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('名字'),
            'pwd' => $this->string()->notNull()->comment('密码'),
            'logo' => $this->string()->comment('头像'),
            'login_time' => $this->date()->notNull()->comment('最后登陆时间'),
            'login_ip' => $this->string()->notNull()->comment('最后登陆ip'),
        ]);
    }

    public function safeDown()
    {
        echo "m170614_104834_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170614_104834_user cannot be reverted.\n";

        return false;
    }
    */
}
