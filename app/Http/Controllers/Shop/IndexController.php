<?php
namespace App\Http\Controllers\Shop;

use App\Models\Goods;
use App\Models\GoodsDetail;
use Barryvdh\Debugbar\Controllers\BaseController;

/**
 * Created by PhpStorm.
 * User: hiho
 * Date: 16-12-2
 * Time: 下午1:12
 */
class IndexController extends BaseController
{

    /**
     * 商城首页
     */
    public function index()
    {

        $goodsList = GoodsDetail::with(['goods' => function ($query) {
            $query->where('is_sale', '=', 1);
        }])->where('is_sale', '=', 1)->get()->where('goods', '<>', null);
//        $goodsList = Goods::where('is_sale', '1')->get();
//        var_dump($goodsList->toArray());
//        return;
        return view('shop.index', ['goodsList' => $goodsList]);
    }

}