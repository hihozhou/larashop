<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->unique()->nullable()->default(NULL)->comment('用户登录唯一用户名');
            $table->string('phone',11)->unique()->nullable()->default(NULL)->comment('手机号码');
            $table->string('email')->unique()->nullable()->default(NULL)->comment('绑定的邮箱');
            $table->string('unionid',255)->unique()->nullable()->default(NULL)->comment('unionid,微信登录账户id');
            $table->string('password')->nullable()->default(NULL);
            $table->string('nickname',32)->nullable()->default(NULL)->comment('昵称');
            $table->tinyInteger('sex')->nullable()->default(NULL)->comment('性别,0是女,1是男');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
