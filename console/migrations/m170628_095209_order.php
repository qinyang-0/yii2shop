<?php

use yii\db\Migration;

class m170628_095209_order extends Migration
{
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
//            id	primaryKey
//            member_id	int	用户id
            'member_id'=>$this->integer()->comment('用户id'),
//            name	varchar(50)	收货人
            'name'=>$this->string(50)->comment('收货人'),
//            province	varchar(20)	省
            'province'=>$this->string(20)->comment('省'),
//            city	varchar(20)	市
            'city'=>$this->string(20)->comment('市'),
//            area	varchar(20)	县
            'area'=>$this->string(20)->comment('县'),
//            address	varchar(255)	详细地址
            'address'=>$this->string(255)->comment('详细地址'),
//            tel	char(11)	电话号码
            'tel'=>$this->char(11)->comment('电话号码'),
//            delivery_id	int	配送方式id
            'delivery_id'=>$this->integer()->comment('配送方式id'),
//            delivery_name	varchar	配送方式名称
            'delivery_name'=>$this->string(255)->comment('配送方式名称'),
//            delivery_price	float	配送方式价格
            'delivery_price'=>$this->float()->comment('配送方式价格'),
//            payment_id	int	支付方式id
            'payment_id'=>$this->integer()->comment('支付方式id'),
//            payment_name	varchar	支付方式名称
            'payment_name'=>$this->string(255)->comment('支付方式名称'),
//            total	decimal	订单金额
            'total'=>$this->decimal()->comment('订单金额'),
//            status	int	订单状态（0已取消1待付款2待发货3待收货4完成）
            'status'=>$this->integer(1)->comment('订单状态'),
//            trade_no	varchar	第三方支付交易号
            'trade_no'=>$this->string(255)->comment('第三方支付交易号'),
//            create_time	int	创建时间
            'create_time'=>$this->integer()->comment('创建时间'),
        ]);

    }

    public function safeDown()
    {
        echo "m170628_095209_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170628_095209_order cannot be reverted.\n";

        return false;
    }
    */
}
