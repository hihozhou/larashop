<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatFanInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('wechat_fan_infos', function (Blueprint $table) {
            $table->integer('user_id')->comment('用户id,主键');
            $table->primary('user_id');
            $table->string('nickname',100)->nullable()->comment('nickname');
            $table->tinyInteger('sex')->comment('性别,0是女,1是男');
            $table->string('country',30)->nullable()->comment('国家');
            $table->string('province',30)->nullable()->comment('省份');
            $table->string('city',30)->nullable()->comment('城市');
            $table->string('headimgurl',80)->nullable()->comment('头像链接');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('wechat_fan_infos');
    }
}
