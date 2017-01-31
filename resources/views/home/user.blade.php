<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta content="telephone=no" name="format-detection"/>

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/home/user.css')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>

    </style>

</head>


<body style="background-color:#efefef;">
<!-- 头像信息 开始 -->
<div class="headInfo">
    <div class="infoCon">
        <img src="{{elixir('images/home/user/anonymous.jpg')}}">
        <span>{{$user->nickname}}</span>
    </div>
</div>
<!-- 头像信息 结束 -->

<!-- 个人信息 开始 -->
<div class="perInfo clearfix">
    <a href="javascript:return false;">
        <span>0.00</span>
        <span>我的余额</span>
    </a>
    <a href="javascript:return false;">
        <span>0</span>
        <span>积分</span>
    </a>
    <a href="javascript:return false;">
        <img src="{{elixir('images/home/user/qr_code.png')}}">
        <span>我的二维码</span>
    </a>
</div>
<!-- 个人信息 结束 -->

<!-- 维修列表 开始 -->
<ul class="maintainList">
    <li class="li">
        <a href="{{route('home.order.index')}}">
            <img src="{{elixir('images/home/user/order.png')}}">
            <p>我的订单</p>
        </a>
    </li>
    <li>
        <a href="{{route('home.cart.index')}}">
            <img src="{{elixir('images/home/user/cart.png')}}">
            <p>购物车</p>
        </a>
    </li>
    <li class="hid">
        <a href="{:U('WechatWeb/User/shopOrderList')}">
            <img src="{{elixir('images/home/user/coupon.png')}}">
            <p>优惠券</p>
        </a>
    </li>
    <li class="li">
        <a href="{{route('home.address.index')}}">
            <img src="{{elixir('images/home/user/location.png')}}">
            <p>我的地址</p>
        </a>
    </li>

</ul>

{{-- jQuery --}}
{{--TODO --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
{{--<script src="{{ elixir('js/home/myc.js')}}"></script>--}}
        <!-- Scripts -->
{{--<script src="{{ elixir('js/admin/app.js') }}"></script>--}}
{{--<script src="/js/app.js"></script>--}}

<script>


</script>

</body>
</html>
