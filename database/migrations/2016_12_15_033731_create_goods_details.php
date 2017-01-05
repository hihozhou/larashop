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
            $table->tinyInteger('is_sale')->comment('商品是否销售');
            $table->integer('stock')->comment('库存');
            $table->integer('sales')->comment('销量');
            $table->integer('image_id')->comment('商品封面图');
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
