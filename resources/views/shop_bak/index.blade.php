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
    <link href="{{ elixir('css/admin/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ elixir('css/shop/common.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/shop/swiper.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/shop/index.css')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        .poster {
            width: 100%;
        }

        .poster img {
            display: block;
            width: 100%;
        }

        .fb {
            padding: 10px 0 0 0;
        }

        .img {
            width: 80%;
            vertical-align: bottom;
            float: none;
        }

        .swiper-wrapper img {
            width: 100%;
        }

        .fbdetail span {
            font-size: 14px;
        }

        .list_detail:nth-child(2n+1) {
            padding-left: 3px;
            border-right: 7px solid #f8f8f8;
            background: white;
            height: 220px;
        }

        .list_detail:nth-child(2n) {
            padding-right: 3px;
            padding-left: 3px;
            border-left: 7px solid #f8f8f8;
            background: white;
            height: 220px;
        }

        .col-xs-12 {
            width: 100%;
            text-align: center;
        }

        .list_detail_text {
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /*输入验证码*/
        .codeCon {
            position: fixed;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 99;
        }

        .codeConMain {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 90%;
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            -o-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            border-radius: 4px;
            padding: 15px;
            background-color: #fff;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .codePhone {
            font-size: 16px;
            text-align: center;
        }

        .inputCon {
            position: relative;
            width: 100%;
            height: 40px;
            line-height: 40px;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 10px 0;
        }

        .inputCon > span {
            width: 60px;
        }

        .inputCon > input {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            padding-left: 15px;
            border: 1px solid #e4e4e4;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        .inputCon > i {
            position: absolute;
            right: 10px;
            top: 15px;
            display: inline-block;
            width: 8px;
            height: 8px;
            border-style: solid;
            border-width: 1px;
            border-color: #333 #333 transparent transparent;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        #getCode {
            position: absolute;
            right: 10px;
            top: 5px;
            padding: 0 10px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 4px;
            color: #fff;
            background-color: #8dbce2;
            z-index: 2;
        }

        #getCode:active {
            background-color: #7aa4c6;
        }

        .codeBtn {
            text-align: center;
            line-height: 35px;
            border-radius: 4px;
            color: #fff;
            background-color: #ff6445;
        }

        .header {
            background-color: #ffda44;
            position: relative;
            width: 100%;
            max-width: 640px;
            margin: 0 auto;
        }

        .header a {
            position: absolute;
            top: 0;
            height: 100%;
            text-align: center;
        }

        .header a img {
            width: 80%;
            display: inline-block;
            vertical-align: middle;
        }

        .header a.a1 {
            left: 0;
            padding-left: 10px;
            width: 30%
        }

        .header a.a1 img {
            width: 15px;
        }

        .header a.a1 span {
            color: #333;
            display: inline-block;
            vertical-align: middle;
            font-size: 18px;
        }

        .header a.a1 p {
            position: absolute;
            top: 50%;
            transform: translate3d(0, -50%, 0);
        }

        .header a.a2 {
            right: 0;
            padding-right: 10px;
            width: 11%;
        }

        .header a.a2 img {
            width: 36%;
            position: absolute;
            top: 50%;
            transform: translate3d(0, -50%, 0);
        }

        .header h1 {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 3% 0;
            color: #333;
            letter-spacing: 2px;
        }


    </style>

</head>
<div class="codeCon">
    <div class="codeConMain">
        <div class="codePhone">绑定手机号码</div>
        <div class="inputCon border_b">
            <span>手机号</span>
            <input type="tel" id="phone" placeholder="请填写您的手机号"/>
            <label id="getCode">获取验证码</label>
        </div>
        <div class="inputCon border_b">
            <span>验证码</span>
            <input type="tel" id="code" placeholder="请填写验证码"/>
        </div>
        <div class="codeBtn">绑定手机号码</div>
    </div>
</div>
{{--<div class="site_banner pull-left">--}}
{{--限时抢购--}}
{{--</div>--}}

<!-- 头部导航 开始 -->
<div class="header">
    <a href="javascript:void(0);" class="a1">
        <p>
            <img src="{{ elixir('images/shop/index/location.png')}}">
            {{--<span>{$user.city}</span>--}}
            <span></span>
        </p>
    </a>
    <h1 style="margin-top: 0px;">限量商城</h1>
    <a href="javascript:void(0);" class="a2">
        <img src="{{ elixir('images/shop/index/user.png')}}">
    </a>
</div>
<!-- 头部导航 结束 -->

<body class="skin-blue sidebar-mini">
@foreach($goodsList as $goods)
    <a href="/goods/{{$goods->id}}" class="col-xs-6 list_detail">
    <span class="col-xs-12 list">
            <img src="{{\App\Models\Image::baseUrl($goods->banner_src->name)}}" class="img" alt=""/>
        </span>
    <span class="list_detail_text">
           {{$goods->name}}
        </span>
    <span class="list_detail_price">
            {{$goods->min_price->price}} 元
        </span>
    </a>
@endforeach

{{-- jQuery --}}
{{--TODO --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
<!-- Scripts -->
<script src="{{ elixir('js/admin/app.js') }}"></script>
{{--<script src="/js/app.js"></script>--}}
</body>
</html>
