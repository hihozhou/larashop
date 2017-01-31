<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\BaseController;
use App\User;
use Illuminate\Http\Request;
use Auth;

class AuthController extends BaseController
{
    /**
     * 获取登录验证码
     *
     * @return \Illuminate\Http\Response
     */
    public function code(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'phone' => 'required|numeric|digits:11',
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        $phone = $request->phone;
        if ($this->getCodeLastTime() >= time()) {
            return $this->jsonFailResponse('请勿频发获取验证码');
        }
        $this->sendCode($phone);
        $this->setCodeLastTime(time());
        return $this->jsonSuccessResponse(['code' => $this->getPhoneCode($phone)]);
    }

    private function generateCode()
    {
        return getRandomStr(4, '0123456789');
    }

    private function sendCode($phone)
    {
        $code = $this->generateCode();
        yunPainTplSendSms(1, $phone, "#code#={$code}");
        $this->cachePhoneCode($phone, $code);
    }

    private function cachePhoneCode($phone, $code)
    {
        \Cache::put('login_code_' . $phone, $code, 10);
    }

    private function getPhoneCode($phone)
    {
        return \Cache::get('login_code_' . $phone);
    }

    private function getCodeLastTime()
    {
        return session('getLoginCodeTime', 0);
    }

    private function setCodeLastTime($time)
    {
        session()->put('getLoginCodeTime', $time);
    }

    private function checkCode($phone, $code)
    {
        return $this->getPhoneCode($phone) == $code;
    }


    /**
     * 登录接口
     */
    public function login(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'phone' => 'required|numeric|digits:11',
            'code' => 'required|numeric|digits:4',
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        if (!$this->checkCode($request->phone, $request->code)) {
            return $this->jsonFailResponse('验证码错误');
        }

        //判断该电话号码是否存在,如果存在直接登录,如果不存在直接注册和登录
        $user = User::firstOrCreate(['phone' => $request->phone]);
        Auth::login($user);
        return $this->jsonSuccessResponse();
    }

    public function showLoginForm()
    {
        return view('home.login');
    }


}
