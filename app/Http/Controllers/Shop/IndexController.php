<?php
namespace App\Http\Controllers\Shop;

use App\Models\Goods;
use App\Models\GoodsDetail;
use App\Models\GoodsSku;
/**
 * Created by PhpStorm.
 * User: hiho
 * Date: 16-12-2
 * Time: 下午1:12
 */
class IndexController extends \App\Http\Controllers\BaseController
{

    /**
     * 商城首页
     */
    public function index()
    {
//        $goodsList = GoodsDetail::with(['goods' => function ($query) {
//            $query->where('is_sale', '=', 1);
//        }])->where('is_sale', '=', 1)->get()->where('goods', '<>', null);
//        $goodsList=GoodsDetail::where('is_sell','=',1)->get();
        $goodsList = Goods::with(['min_price', 'banner_src'])->where('is_sale', 1)->get();
//        $goodsList = Goods::where('is_sale', '1')->get();
//        var_dump($goodsList->toArray());
//        return;
//        return;
        return view('shop.index', ['goodsList' => $goodsList]);
    }

    public function goods($id)
    {
        $goods = Goods::with('details.skus.sku')->findOrFail($id);
        //TODO 删除没有组合的sku选项
//        var_dump($goods->sku_types()->toJson());exit;
        return view('shop.goods', ['goods' => $goods]);
    }

}