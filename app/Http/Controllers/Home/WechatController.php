<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use Overtrue\Socialite\AuthorizeFailedException;

class WechatController extends Controller
{


    public function oauth()
    {

        $config = [
            // ...
            'debug' => true,
            'app_id' => 'wxbf119b885147c9ba',
            'secret' => 'b8998eeb8a6d8a690a59aa5ec28b0c93',
            'token' => 'KObL62GdYx',//回调需要
            'aes_key' => 'M6wWHCgcesWriUnUJ2L4ubk8Rifg4xqv1M9n3QNxlJQ',//高级功能需要
        ];
        $wechat = new Application($config);
        $app = new Application($config);
        $oauth = $app->oauth;
        //微信验证
        try {
            $user = $oauth->user();
            //判断用户是否存在
            //用户记录操作
            //用户登录
            //跳转到session页面
            return redirect(session('wechat_target_url'));
        } catch (AuthorizeFailedException $e) {
            //验证失败
            throw $e;
        } catch (\Exception $e) {
            //
            throw $e;
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return 111;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
