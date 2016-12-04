<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\LoginController AS Controller;

class LoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * define login view
     * @var string
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function __construct()
    {
        $this->middleware('admin.guest', ['except' => 'logout']);
    }
}
