<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="telephone=no" name="format-detection"/>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ elixir('css/shop/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ elixir('css/shop/base.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/shop/common.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/shop/iosOverlay.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/shop/cart.css')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body>

<div class="cart_wrapper clearfix">
    @foreach($cartGoodsList as $cartGoods)
        <div class="cart_list col-xs-12" data-id="{{$cartGoods->id}}"
             data-goods-detail-id="{{$cartGoods->goods_detail_id}}"
             data-goods-detail-price="{{$cartGoods->goods_detail->price}}">
            <a href="javascript:void(0)" class="cart_img">
                <img src="{{\App\Models\Image::baseUrl($cartGoods->goods_detail->image_src->name)}}" class="img"
                     alt=""/>
            </a>
            <div class="col-xs-12">
                <h3 class="cart_title">{{$cartGoods->goods_detail->goods->name}}</h3>
                <div class="block_wraper clearfix">
                    @foreach($cartGoods->goods_detail->skus as $sku)
                        <span class="pull-left">
                        	{{$sku->sku->name}}
                    </span>
                    @endforeach
                </div>
                <p class="red price_wraper">
                    <span class="red">
                        单价 : ￥
                    </span>
                    <span class="red goods_price">
                        {{$cartGoods->goods_detail->price}}
                    </span>
                    {{--<span class="red">--}}
                        {{--总价:￥--}}
                    {{--</span>--}}
                    {{--<span class="red goods_price">--}}
                        {{--{{$cartGoods->goods_detail->price}}--}}
                    {{--</span>--}}

                </p>
                <div class="clearfix goods_count_wraper">
                    <a href="javascript:void(0)" class="count_btn minus_count pull-left can">
                        <img src="{{ elixir('images/shop/minus_count.png')}}" class="img" alt=""/>
                    </a>
                <span class="counted pull-left">
                {{$cartGoods->num}}
                </span>
                    <a href="javascript:void(0)" class="count_btn add_count pull-left can">
                        <img src="{{ elixir('images/shop/add_count.png')}}" class="img" alt=""/>
                    </a>
                </div>
            </div>
            <div class="cart_list_delete">

            </div>
            @if(property_exists($cartGoods,'error_msg'))
                <p class="text-danger col-xs-12 pt5">
                    错误信息：{{$cartGoods->error_msg}}
                </p>
            @endif
        </div>
    @endforeach
</div>

<div class="cart_foot">
        <span class="cart_foot_text pull-left">
            数量：<span class="total_count">
                {{$cartGoodsList->sum(function($cartGoods){return $cartGoods->num;})}}
            </span>件&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;总额：￥<span class="total_price">
                {{$cartGoodsList->sum(function ($cartGoods) {
                    return $cartGoods->goods_detail->price*$cartGoods->num;
                })}}
            </span>
        </span>
    <a href='{:U("WechatWeb/Shop/shopAddress")}' class="btn-sm btn btn-warning pull-right" id="buy_now">
        立即结算
    </a>
</div>

{{--<div class="order_wrapper" style="background: #ffffff;margin-top: 60px;padding-bottom: 30px;display: none;">--}}
{{--<div style="width:90px;margin:0px auto;padding:20px 0px 10px 0px;" class="clearfix">--}}
{{--<img src="__STATICS__/mobile/images/shop/sad.png" class="img" alt=""/>--}}
{{--</div>--}}
{{--<h3 style="text-align: center;color:#656565;">购物车为空！</h3>--}}


{{--<div style="width:40%;margin:10px auto 10px;" class="clearfix">--}}
{{--<a href="javascript:void(0)" class="btn btn-sm btn-warning">--}}
{{--返回首页--}}
{{--</a>--}}
{{--</div>--}}
{{--</div>--}}

<script>
    var cart_goods_add = '{{route('shop.cart.add')}}';
    var cart_goods_subtract = '{{route('shop.cart.subtract')}}';
    var cart_goods_delete = '/cart/';
    var loading_url = '/images/shop/';
</script>

{{-- jQuery --}}
{{--TODO --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
<!-- Scripts -->
<script src="{{ elixir('js/app.js')}}"></script>
<script src="{{ elixir('js/shop/swiper.jquery.min.js')}}"></script>
<script src="{{ elixir('js/shop/fastclick.js')}}"></script>
<script src="{{ elixir('js/shop/spin.min.js')}}"></script>
<script src="{{ elixir('js/shop/iosOverlay.js')}}"></script>
<script src="{{ elixir('js/shop/cart.js')}}"></script>
</body>
</html>
