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

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        body
        {
            background: #ffffff;
        }
        .btn-sm, .btn-group-sm > .btn {
            padding: 5px 10px;
        }

        .mc {width: 100%;height: 100%;position:fixed;left: 0;top: 100%;z-index: 10;}

        .aBtn {width: 100%;position: absolute;left: 0;bottom: 0;background-color: rgba(0,0,0,.3);padding: 5% 0;}

        .mc a {display: block;text-align: center;font-size: 16px;color: #fff;font-family: "microsoft yahei";padding: 3% 0;width: 100%;}

        .mc a >img {display: inline-block;width: 12%;vertical-align: middle;}

        .mc a > span {display: inline-block;vertical-align: middle;color: #fff;margin-left: 5%;}

    </style>

</head>

<body class="clearfix">

<div class="order_wrapper" style="background: #ffffff;margin-top: 60px;">
    <div style="width:90px;margin:0px auto;padding:20px 0px 10px 0px;" class="clearfix">
        <img src="{{ elixir('images/home/smile.png')}}" class="img" alt=""/>
    </div>
    <h3 style="text-align: center;color:#656565;">您的订单已成功提交！</h3>
    <p style="text-align: center;color:#999999;margin-bottom: 10px;">我们会在24小时内致电与您核实订单，请保持电话畅通。</p>
    <p style="text-align: center;color:#999999;margin-bottom: 10px;">编号：<strong>{{$order->sn}}</strong></p>
    <p style="text-align: center;color:#999999;margin-bottom: 10px;">订单金额：<strong>￥{{$order->total_price}}</strong></p>
    {{--<div style="width:80%;margin:10px auto 10px;" class="clearfix">--}}
        {{--<a href="javascript:void(0)" class="btn btn-sm btn-success" id="cash_now">--}}
            {{--马上支付--}}
        {{--</a>--}}
    {{--</div>--}}
    <div style="width:80%;margin:0 auto;" class="clearfix">
        <div class="col-xs-6" style="padding-right: 10px;">
            <a href="{{route('home.order.index')}}" class="btn btn-sm btn-success">
                查看订单
            </a>
        </div>
        <div class="col-xs-6 pl10" style="padding-left: 10px;">
            <a href="{{route('home.index')}}" class="btn btn-sm btn-success">
                继续购物
            </a>
        </div>
    </div>
</div>

{{-- jQuery --}}
{{--TODO --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
<script>
</script>


<!-- Scripts -->
<script src="{{ elixir('js/app.js')}}"></script>
<script src="{{ elixir('js/home/fastclick.js')}}"></script>
<script src="{{ elixir('js/home/spin.min.js')}}"></script>
<script src="{{ elixir('js/home/iosOverlay.js')}}"></script>
</body>
</html>
