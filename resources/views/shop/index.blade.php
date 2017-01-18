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


    </style>

</head>
<div class="site_banner pull-left">
    限时抢购
</div>
<body class="skin-blue sidebar-mini">
@foreach($goodsList as $goods)
    <a href="/goods/{{$goods->goods_id}}" class="col-xs-6 list_detail">
    <span class="col-xs-12 list">
            <img src="{{\App\Models\Image::baseUrl($goods->image_src->name)}}" class="img" alt=""/>
        </span>
    <span class="list_detail_text">
           {{$goods->goods->name}}
        </span>
    <span class="list_detail_price">
            {{$goods->price}} 元
        </span>
    </a>
@endforeach

{{-- jQuery --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
<!-- Scripts -->
<script src="{{ elixir('js/admin/app.js') }}"></script>
{{--<script src="/js/app.js"></script>--}}
</body>
</html>
