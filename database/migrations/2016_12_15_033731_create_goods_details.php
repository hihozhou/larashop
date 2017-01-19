<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_id')->comment('商品id');
            $table->tinyInteger('is_sale')->default(0)->comment('商品是否销售：0否，1是');
            $table->integer('stock')->default(0)->comment('库存');
            $table->integer('sales')->default(0)->comment('销量');
            $table->integer('image_id')->comment('商品封面图');
            $table->decimal('original', 10, 2)->default(0.00)->comment('原价');
            $table->decimal('price', 10, 2)->default(0.00)->comment('售价');
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
        Schema::dropIfExists('goods_details');
    }
}
