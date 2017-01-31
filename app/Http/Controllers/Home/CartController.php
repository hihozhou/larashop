<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\BaseController;
use App\Models\Cart;
use App\Models\GoodsDetail;
use App\Models\GoodsSales;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO 加入just参数
        $user = \Auth::user();
        $cartGoodsList = Cart::with([
            'goods_detail' => function ($query) {
                $query->with('image_src');
                $query->with('goods');
                $query->with('skus.sku');
            },
        ])->where(['user_id' => $user->id])
            ->orderBy('updated_at', 'DESC')->get();
//        var_dump($cartGoodsList->toArray());
//        return;
        return view('home.cart', ['cartGoodsList' => $cartGoodsList]);
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
        //添加货跳转
        $data = $request->all();
        $validator = \Validator::make($data, [
            'num' => 'required|min:1',
            'goods_detail_id' => 'required|exists:goods_details,id,deleted_at,NULL,stock,!0,is_sale,1',
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        $user = \Auth::user();
        //判断购物车是否存在该商品记录
        $cartGoods = Cart::firstOrNew(['user_id' => $user->id, 'goods_detail_id' => $request->goods_detail_id]);
        if (!$cartGoods->exists) {
            $cartGoods->fill(['user_id' => $user->id, 'goods_detail_id' => $request->goods_detail_id, 'num' => $request->num])->save();
        } else {
            //判断商品是否
            $goodsDetail = GoodsDetail::with(['goods' => function ($query) {
                $query->where('is_sale', 1);
            }])->where('is_sale', 1)->where('stock', '>', 0)
                ->find($request->goods_detail_id);
            if (empty($goodsDetail) || empty($goodsDetail->goods)) {
                return $this->jsonFailResponse('商品已下架');
            }
            //判断怎加多少到购物车
            $surplus = $goodsDetail->stock - $cartGoods->num;
            if ($surplus > 0) {
                if ($surplus < $request->num) {
                    $request->num = $surplus;
                }
                $cartGoods->num = $cartGoods->num + $request->num;
                $cartGoods->save();
            }


        }
        return $this->jsonSuccessResponse();
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
        $cartGoods = Cart::where('user_id', \Auth::user()->id)->findOrFail($id);
        $cartGoods->delete();
        return $this->jsonSuccessResponse();
    }


    public function add(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'num' => 'required|min:1',
            'goods_detail_id' => 'required|exists:goods_details,id,deleted_at,NULL,stock,!0,is_sale,1',
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        $user = \Auth::user();
        $cartGoods = Cart::where('user_id', $user->id)
            ->where('goods_detail_id', $request->goods_detail_id)->firstOrFail();
        $goodsDetail = GoodsDetail::where('id', $request->goods_detail_id)->firstOrFail();

        if ($cartGoods->num + $request->num > $goodsDetail->stock) {
            return $this->jsonFailResponse('库存不足');
        }
        $cartGoods->num = $cartGoods->num + $request->num;
        $cartGoods->save();
        return $this->jsonSuccessResponse();

    }

    public function subtract(Request $request)
    {
        $data = $request->all();
        $validator = \Validator::make($data, [
            'num' => 'required|min:1',
            'goods_detail_id' => 'required|exists:goods_details,id,deleted_at,NULL,stock,!0,is_sale,1',
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }
        $user = \Auth::user();
        $cartGoods = Cart::where('user_id', $user->id)
            ->where('goods_detail_id', $request->goods_detail_id)->firstOrFail();
        $cartGoods->num = $cartGoods->num - $request->num;
        if ($cartGoods->num == 0) {
            return $this->jsonFailResponse('已经没有了');
        }
        $cartGoods->save();
        return $this->jsonSuccessResponse();
    }
}
