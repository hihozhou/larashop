<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('wechat_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60)->comment('公众号名称');
            $table->string('original_id',20)->comment('原始id');
            $table->string('app_id',50)->nullable()->comment('AppId');
            $table->string('app_secret',50)->nullable()->comment('AppSecret');
            $table->string('token',10)->nullable()->comment('加密token');
            $table->string('aes_key',43)->nullable()->comment('AES加密key,EncodingAESKey');
            $table->string('wechat_account',20)->comment('微信号');
            $table->string('access_token',30)->nullable()->comment('微信access_token');
            $table->tinyInteger('account_type')->nullable()->default(1)->comment('类型(1订阅号,2服务号,3企业号)');
            $table->tinyInteger('sync_status')->nullable()->default(0)->comment('同步状态(1图片同步,2图文同步,3视频同步,4声音同步,5菜单同步)');
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
        Schema::drop('wechat_accounts');
    }
}
