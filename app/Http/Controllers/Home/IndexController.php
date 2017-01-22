<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: hiho
 * Date: 16-12-2
 * Time: 下午1:12
 */
class IndexController extends Controller
{

    public function __construct()
    {

    }

    /**
     *
     */
    public function index()
    {
//        echo "123";
        return view('home.index');
    }
}