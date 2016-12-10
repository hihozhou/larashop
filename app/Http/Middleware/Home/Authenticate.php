<?php

namespace App\Http\Middleware\Home;

use Closure;
use EasyWeChat\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($this->isWechat()) {
                //跳转到微信授权链接
                return $this->wechatAuthorized();
            } else {
                if ($request->ajax() || $request->wantsJson()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect('/login');
                }
            }
        }
        return $next($request);
    }

    private function isWechat()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }

    public function wechatAuthorized()
    {
        $config = [
            // ...
            'oauth' => [
                'scopes' => ['snsapi_userinfo'],
                'callback' => '/oauth_callback',
            ],
            // ..
            'debug' => true,
            'app_id' => 'wxe55e04b26a1df3d8',
            'secret' => 'c82936514cbf64046d296e8d58deca62',
            'token' => 'KObL62GdYx',//回调需要
            'aes_key' => 'M6wWHCgcesWriUnUJ2L4ubk8Rifg4xqv1M9n3QNxlJQ',//高级功能需要
        ];
        $app = new Application($config);
        session('wechat_target_url', \Request::getRequestUri());
        return $app->oauth->redirect();
    }

}
