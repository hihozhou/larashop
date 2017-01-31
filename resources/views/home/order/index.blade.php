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
    <link href="{{ elixir('css/home/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ elixir('css/home/base.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/home/common.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/home/swiper.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/home/iosOverlay.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/home/order_list.css')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <style>
        .mc {
            width: 100%;
            height: 100%;
            position: fixed;
            left: 0;
            top: 100%;
            z-index: 10;
        }

        .aBtn {
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, .7);
            padding: 5% 0;
        }

        .mc a {
            display: block;
            text-align: center;
            font-size: 16px;
            color: #fff;
            font-family: "microsoft yahei";
            padding: 3% 0;
            width: 100%;
        }

        .mc a > img {
            display: inline-block;
            width: 12%;
            vertical-align: middle;
        }

        .mc a > span {
            display: inline-block;
            vertical-align: middle;
            color: #fff;
            margin-left: 5%;
        }

    </style>

</head>

<body>

@if($orders->count()==0)
    <div class="warningBlock border_radius_4">
        <div class="warningLogo">
            <img src="{{elixir('images/home/blue_warning.png')}}" class="img" alt=""/>
        </div>
        <p class="warningText">
            你还没有去购物~
        </p>
    </div>
@else
    @foreach($orders as $order)
        <div class="order_list clearfix" data-sn="{{$order->sn}}"
             data-url="{{route('home.order.show',['sn'=>$order->sn])}}">
            <p class="order_top_top clearfix">
            <span class="order_num pull-left">
                订单编号: {{$order->sn}}
            </span>
            <span class="order-status pull-right">
                订单状态：
                <span class="red">
                    @if($order->status==1)
                        等待商品出库
                    @elseif($order->status==2)
                        等待发货
                    @elseif($order->status==3)
                        等待签收
                    @else
                        订单完成
                    @endif
                </span>
            </span>
            </p>
            @foreach($order->details as $orderDetail)
                <a href="javascript:void(0)" class="order_top col-xs-12">
                <span class="order_img clearfix">
                    <img src="{{\App\Models\Image::baseUrl($orderDetail->goods_detail->image_src->name)}}" class="img"
                         alt=""/>
                </span>
                    <span class="order_title col-xs-12">{{$orderDetail->goods_detail->goods->name}}</span>
                <span class="block_wraper col-xs-12">
                    @foreach($orderDetail->goods_detail->skus as $sku)
                        <span class="pull-left">{{$sku->sku->name}}</span>
                    @endforeach
                </span>

                    <p class="order_top_price col-xs-12">
                        价格：
                        <span class="red">￥{{$orderDetail->price}} * {{$orderDetail->num}}</span>
                    </p>
                </a>
            @endforeach
        </div>


    @endforeach
@endif



{{-- jQuery --}}
{{--TODO --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
<script>
    $(function () {
        // 点击跳到订单详情页
        $(".order_list").on("click", function () {
            var url = $(this).attr("data-url");
            window.location.href = url;
        });
    });
</script>


<!-- Scripts -->
<script src="{{ elixir('js/app.js')}}"></script>
<script src="{{ elixir('js/home/fastclick.js')}}"></script>
<script src="{{ elixir('js/home/spin.min.js')}}"></script>
<script src="{{ elixir('js/home/iosOverlay.js')}}"></script>
</body>
</html>
