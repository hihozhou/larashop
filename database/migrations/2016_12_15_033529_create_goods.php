<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('商品名称');
            $table->tinyInteger('is_sale')->default(0)->comment('是否销售：0否，1是');
            $table->string('sku_top_id')->comment('商品sku最高级别id，goods_skus中pid=0');
            $table->string('sku_type_ids')->comment('商品sku id list，goods_skus中第二级别');
            $table->string('desc')->comment('商品简单描述');
            $table->text('description')->comment('参数说明');
            $table->text('content')->comment('商品图文内容');
            $table->integer('banner')->comment('images图片id');
            $table->string('slider')->comment('images图片id字符串，用，分割');
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
        Schema::dropIfExists('goods');
    }
}
