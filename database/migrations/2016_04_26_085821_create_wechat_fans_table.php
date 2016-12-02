<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatFansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('wechat_fans', function (Blueprint $table) {
            $table->integer('user_id')->comment('用户id');
            $table->integer('account_id')->comment('所属公众号');
            $table->primary(['user_id', 'account_id']);
            $table->integer('group_id')->comment('粉丝组group_id');
            $table->string('openid', 100)->comment('openid');
            $table->timestamp('subscribed_at')->default(NULL)->comment('关注时间');
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
        //
        Schema::drop('wechat_fans');
    }
}
