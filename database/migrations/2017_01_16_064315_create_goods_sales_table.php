<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_detail_id')->comment('商品详细id');
            $table->decimal('discount', 10, 2)->default(0.00)->comment('优惠金额');
            $table->tinyInteger('is_sale')->default(0)->comment('商品是否销售：0否，1是');
            $table->integer('stock')->default(0)->comment('库存');
            $table->timestamps();
            $table->timestamp('began_at')->nullable()->comment('开始时间');
            $table->timestamp('ended_at')->nullable()->comment('结束时间');
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
        Schema::dropIfExists('goods_sales');
    }
}
