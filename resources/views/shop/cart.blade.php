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
    <link rel="stylesheet" href="{{ elixir('css/shop/swiper.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/shop/index.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/shop/iosOverlay.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/shop/goods.css')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        img {
            width: auto !important;
        }

        .img1 {
            height: 8px;
            position: relative;
            bottom: 8px;
            left: -3px;

        }

        .img2 {
            height: 19px;
            position: relative;
            bottom: 1px;
            left: -2px

        }

        #detail_goods img {
            width: 100%;
        }

        #data_goods img {
            width: 100%;
        }

        .swiper-slide {
            height: 200px !important;
        }

        .swiper-slide a {
            height: 100% !important;
            overflow: hidden;
        }

        .swiper-slide img {
            /*height: 200px !important;*/
        }

        .col-xs-6 {
            padding-left: 0px;
        }

        .btn-warning {
            background-color: #ffd400;
            border-color: #ffd400;
        }
    </style>

    <script type="text/javascript">
        //图片居中显示
        function center_img(dom) {
            dom.style.visibility = 'hidden';
            var pWideth = dom.parentNode.offsetWidth;
            var pHeight = dom.parentNode.offsetHeight;
            var Wideth = dom.width;
            var Height = dom.height;
//            console.log(pWideth + ":" + pHeight)
//            console.log(Wideth + ":" + Height)
            if (Wideth >= Height) {
                dom.width = pWideth;
                if (dom.height >= pHeight) {
//                    console.log(dom.width + "--" + pHeight + "-dsd-" + dom.height)
                    dom.width = dom.width * pHeight / dom.height;
                    dom.height = pHeight;
                }
            } else {
                dom.height = pHeight;
                if (dom.width >= pWideth) {

                    dom.height = dom.height * pWideth / dom.width;
                    dom.width = pWideth;
                }
//                console.log(dom.width + ":" + dom.height + "----------")
            }
            dom.style.marginLeft = (pWideth - dom.width) / 2 + 'px';
            dom.style.marginTop = (pHeight - dom.height) / 2 + 'px';
            dom.style.visibility = 'visible';

        }
    </script>

</head>

<body>
<div class="swiper-container">
    <div class="swiper-wrapper">
        @foreach($goods->slider_src_list() as $slider_src)
            <div class="swiper-slide">
                <a href="javascript:void(0)">
                    <img src="{{\App\Models\Image::baseUrl($slider_src->name)}}" class="img" alt=""
                         onload="center_img(this)"/>
                </a>
            </div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
<h3 class="detail_text">
    {{$goods->name}}
</h3>

<div class="goods_detail_wrapper">
    <h4 class="price_wraper">
            <span class="red">
                ￥
            </span>
            <span class="red goods_price">
                {{$goods->min_price->price}}~{{$goods->max_price->price}}
            </span>
             <span class="red">
            元
            </span>
            <span class="market_price">
{{--                市场价：￥{{$goods->min_original_price->price}}~{{$goods->max_original_price->price}}--}}
            </span>
    </h4>
    <div class="sku_wraper clearfix">
        <p class="sku_title">颜色</p>
        <div class="sku_list_inner clearfix">
                        <span class="sku_block pull-left">
                            红色
                        </span>
                        <span class="sku_block pull-left">
                            黑色
                        </span>
        </div>
        <p class="sku_title">颜色</p>
        <div class="sku_list_inner clearfix">
                        <span class="sku_block pull-left">
                            红色
                        </span>
                        <span class="sku_block pull-left">
                            黑色
                        </span>
        </div>
    </div>

    <div class="goods_count">
        <p class="sku_title">数量</p>
        <div class="clearfix goods_count_wraper">
            <a href="javascript:void(0)" class="count_btn minus_count pull-left">
                <img src="{{ elixir('images/shop/minus_count.png')}}" class="img1" alt=""/>
            </a>
                <span class="counted pull-left">
                1
                </span>
            <a href="javascript:void(0)" class="count_btn add_count pull-left">
                <img src="{{ elixir('images/shop/add_count.png')}}" class="img2" alt=""/>
            </a>
                 <span class="pull-left" style="padding:5px 3px;">(库存
                <span class="restNum">{{$goods->stock()}}</span>
                件)
        </span>
        </div>

    </div>
</div>

<div class="buy_wraper clearfix">
    <div class="col-xs-6 pr10">
        <a href="javascript:void(0)" class="btn btn-sm btn-warning" id="buy_now">
            立即购买
        </a>
    </div>

    <div class="col-xs-6 pl10">
        <a href="javascript:void(0)" class="btn btn-sm btn-warning" id="go_cart">
            加入购物车
        </a>
    </div>


</div>

<div class="site_banner pull-left">
    <span class="pull-left active goods_qie" data-id="detail_goods">商品详情</span>
    <span class="pull-left goods_qie" data-id="data_goods">商品参数</span>
</div>

<div class="clearfix">
    <!--商品详情-->
    <div class="col-xs-12 " id="detail_goods" style="padding:0 0">
        {!! $goods->content !!}
    </div>
    <!--商品参数-->
    <div class="col-xs-12 " id="data_goods" style="padding:10px 0">
        <p>
            {!! $goods->description !!}
        </p>
    </div>

</div>

<div id="footer" class="col-xs-12">
    {{--<div class=" btn-group">--}}
    {{--<button type="button" class="btn btn-warning edit">购买</button>--}}
    {{--<button type="button" class="btn btn-warning ">购买</button>--}}
    {{--</div>--}}

    <a href='{{url('/')}}' class="col-xs-6" id="home">
            <span class="col-xs-12">
            </span>
    </a>
    <a href='{:U("WechatWeb/Shop/cart")}' class="col-xs-6" id="cart">
    </a>
</div>


<script>
    var skus = JSON.parse('{!! $goods->sku_types()->toJson()!!}');//商品sku组合
    console.log(skus);
    var goodsDetails = JSON.parse('{!! $goods->details->toJson()!!}');//商品详情列表
    console.log(goodsDetails);

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
<script src="{{ elixir('js/shop/goods.js')}}"></script>
</body>
</html>
