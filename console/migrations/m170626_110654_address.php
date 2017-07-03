<?php

use yii\db\Migration;

class m170626_110654_address extends Migration
{
    public function safeUp()
    {
        $this->createTable('address', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(50)->comment('收货人'),
            'member_id'=>$this->integer()->comment('用户id'),
            'province'=>$this->string(50)->comment('省份'),
            'city'=>$this->string(50)->comment('市'),
            'county'=>$this->string(50)->comment('县'),
            'address'=>$this->string(255)->comment('详细地址'),
            'tel'=>$this->char(11)->comment('电话'),
            'status'=>$this->integer(1)->comment('状态'),
        ]);
    }

    public function safeDown()
    {
        echo "m170626_110654_address cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170626_110654_address cannot be reverted.\n";

        return false;
    }
    */
}
