<?php
namespace App\Http\Controllers\Home;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Goods;
use App\Models\GoodsDetail;
use App\Models\GoodsSku;
use App\Models\Order;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: hiho
 * Date: 16-12-2
 * Time: 下午1:12
 */
class OrderController extends \App\Http\Controllers\BaseController
{

    public function store(Request $request)
    {
        $requestData = $request->all();
        $validator = \Validator::make($requestData, [
            'address_id' => 'required|exists:addresses,id,user_id,' . \Auth::user()->id,
        ]);
        if ($validator->fails()) {
            return $this->jsonFailResponse($validator->errors()->first());
        }

        $user = \Auth::user();
        //获取用户所有的购物车商品
        $cartGoodsList = Cart::with(['goods_detail'])->where('user_id', $user->id)->get();
        if (!$cartGoodsList->count()) {
            return $this->jsonFailResponse('购物车为空');
        }
        //计算价格
        $total_price = 0;
        foreach ($cartGoodsList as $cartGoods) {
            if ($cartGoods->num > $cartGoods->goods_detail->stock) {
                return $this->jsonFailResponse($cartGoods->goods_details->goods->name . '库存不足');
            }
            $total_price = $total_price + $cartGoods->num * $cartGoods->goods_detail->price;
        }
        $url = '';
        try {
            \DB::transaction(function () use ($cartGoodsList, $requestData, $total_price, &$url) {
                $address = Address::where('user_id', \Auth::user()->id)->findOrFail($requestData['address_id']);
//                $address = new Address();
                $address->used_at = $address->freshTimestamp();
                $address->save();
                $data = $address->setVisible(Address::getOrderColumns())->toArray();
                $data['total_price'] = $total_price;
                $data['sn'] = Order::generateSn();
//                var_dump($data);exit;
                //生成订单
                $order = Order::create($data);
                $order->order_actions()->create(['desc' => '提交订单']);
                foreach ($cartGoodsList as $cartGoods) {
                    $orderDetail = [
                        'goods_detail_id' => $cartGoods->goods_detail_id,
                        'price' => $cartGoods->goods_detail->price,
                        'num' => $cartGoods->num,
                        'total_price' => $cartGoods->num * $cartGoods->goods_detail->price,
                    ];
//                    var_dump($orderDetail);
                    //添加购物订单详细
                    $order->details()->create($orderDetail);
                    //库存减一
                    $cartGoods->goods_detail->stock = $cartGoods->goods_detail->stock - $cartGoods->num;
                    $cartGoods->goods_detail->sales = $cartGoods->goods_detail->sales + $cartGoods->num;
                    $cartGoods->goods_detail->save();
                    //删除购物车中信息
                    $cartGoods->delete();

                }
                $url = route('home.order.success', ['sn' => $order->sn]);
            });

        } catch (\Exception $e) {
//            throw $e;
            return $this->jsonFailResponse('下单失败');
        }
        return $this->jsonSuccessResponse(['url' => $url]);

    }

    public function success($sn)
    {
        $order = Order::where('sn', $sn)->where('user_id', \Auth::user()->id)->firstOrFail();
        return view('home.order.success', ['order' => $order]);
    }

    public function index()
    {
        $orders = Order::with(['details' => function ($query) {
            $query->with(['goods_detail' => function ($query) {
                $query->with('skus.sku');
                $query->with('image_src');
                $query->with('goods');
            }]);
        }])->where('user_id', \Auth::user()->id)->orderBy('created_at', 'DESC')->get();
//        var_dump($orders->toArray());exit;
        return view('home.order.index', ['orders' => $orders]);
    }


    public function show($sn)
    {
        $order = Order::with(['details' => function ($query) {
            $query->with(['goods_detail' => function ($query) {
                $query->with('skus.sku');
                $query->with('image_src');
                $query->with('goods');
            }]);
        }])->where('user_id', \Auth::user()->id)->where('sn', $sn)
            ->orderBy('created_at', 'DESC')->firstOrFail();
//        var_dump($order->toArray());exit;
        return view('home.order.show', ['order' => $order]);
    }


}