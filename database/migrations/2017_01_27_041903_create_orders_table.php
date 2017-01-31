<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->unique()->comment('用户id');
            $table->integer('user_id')->comment('用户id');
            $table->string('phone')->comment('联系电话');
            $table->string('consignee')->comment('收件人名称');
            $table->string('province')->comment('省份');
            $table->string('city')->comment('城市');
            $table->string('district')->comment('地区');
            $table->string('address')->comment('详细地址');
            $table->string('postcode', 10)->nullable()->default(NULL)->comment('邮政编码');
            $table->string('express')->nullable()->default(NULL)->comment('快递方式');
            $table->string('express_no')->nullable()->default(NULL)->comment('快递单号');
            $table->string('message')->nullable()->default(NULL)->comment('用户留言');
            $table->decimal('total_price', 10, 2)->default(0.00)->comment('订单总金额');
            $table->decimal('discount', 10, 2)->default(0.00)->comment('优惠金额');
            $table->decimal('paid_price', 10, 2)->default(0.00)->comment('支付金额');
            $table->tinyInteger('paid_way')->default(0)->comment('支付途径:0未知,1微信,2支付宝,3现金');
            $table->tinyInteger('paid_type')->default(2)->comment('支付方式:1先支付,2货到付款');
            $table->timestamp('paid_at')->nullable()->default(NULL)->comment('支付时间');
            $table->tinyInteger('status')->default(1)->comment('订单状态:-1取消订单,1提交订单,2商品出库,3发货(寄快递),4签收货物,5完成订单');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
