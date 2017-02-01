<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiscountSaleDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_sale_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discount_sale_id')->comment('促销活动id');
            $table->integer('goods_detail_id')->comment('商品详细id');
            $table->decimal('discount', 10, 2)->default(0.00)->comment('优惠金额');
            $table->tinyInteger('is_sale')->default(0)->comment('商品是否销售：0否，1是');
            $table->integer('stock')->default(0)->comment('库存');
            $table->integer('sort')->default(1)->comment('排序,倒序');
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
        Schema::dropIfExists('discount_sale_details');
    }
}
