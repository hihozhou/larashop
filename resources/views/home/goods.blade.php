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
    <link rel="stylesheet" href="{{ elixir('css/home/index.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/home/iosOverlay.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/home/goods.css')}}"/>

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

        /*输入验证码*/
        .loginForm {
            position: fixed;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 99;
        }

        .loginFormMain {
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

        .loginFormPhone {
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

        .loginBtn {
            text-align: center;
            line-height: 35px;
            border-radius: 4px;
            color: #fff;
            background-color: #ff6445;
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
<div class="loginForm">
    <div class="loginFormMain">
        <div class="loginFormPhone">手机号码登录</div>
        <div class="inputCon border_b">
            <span>手机号</span>
            <input type="tel" id="phone" placeholder="请填写您的手机号"/>
            <label id="getCode">获取验证码</label>
        </div>
        <div class="inputCon border_b">
            <span>验证码</span>
            <input type="tel" id="code" placeholder="请填写验证码"/>
        </div>
        <div class="loginBtn">登录</div>
    </div>
</div>

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
                <img src="{{ elixir('images/home/minus_count.png')}}" class="img1" alt=""/>
            </a>
                <span class="counted pull-left">
                1
                </span>
            <a href="javascript:void(0)" class="count_btn add_count pull-left">
                <img src="{{ elixir('images/home/add_count.png')}}" class="img2" alt=""/>
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
    <a href='{{route('home.cart.index')}}' class="col-xs-6" id="cart">
    </a>
</div>

{{--TODO --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
<script src="{{ elixir('js/home/myc.js')}}"></script>
<script>
    var skus = JSON.parse('{!! $goods->sku_types()->toJson()!!}');//商品sku组合
    console.log(skus);
    var goodsDetails = JSON.parse('{!! $goods->details->toJson()!!}');//商品详情列表
    console.log(goodsDetails);
    var add_cart_url = '{{ route('home.cart.store')}}';
    var loading_url = '/images/home/';
    var cart_url = '{{route('home.cart.index')}}';

    //关闭绑定手机号码蒙层
    $('.loginForm').click(function (e) {
        e.stopPropagation();
        $('.loginForm').css('display', 'none');
    });
    $('.loginFormMain').click(function (e) {
        e.stopPropagation();
    });

    function repeat(time, callbcak) {
        if (time > 0) {
            callbcak(time);
            time--;
            setTimeout(function () {
                repeat(time, callbcak);
            }, 1000);
        } else {
            callbcak(0);
        }
    }

    //点击获取验证码
    $('#getCode').click(function () {
        var phone = $('#phone').val();
        if ($(this).text().indexOf('验证码') > -1) {
            if (!phone) {
                myc.alert({
                    msg: '请输入手机号码'
                });
                return false;
            }
            if (!myc.regularPhoneNumber(phone)) {
                myc.alert({
                    msg: '输入手机号码格式不对'
                });
                return false;
            }
            myc.showProgress({
                title: '获取验证码中'
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: '{{route('home.login.code')}}',
                data: {
                    phone: phone
                },
                success: function (rep) {
                    if (rep.error_code === 0) { //成功
                        myc.toast({
                            msg: '获取验证码成功，请留意短信'
                        });
                        var time = 60;
                        var getCode = $('#getCode');
                        getCode.html(time + 's');
                        getCode.css('backgroundColor', '#c7c7c7');
                        repeat(time, function (time) {
                            if (time != 0) {
                                getCode.html(time + 's');
                            } else {
                                getCode.html('获取验证码');
                                getCode.css('backgroundColor', '#8dbce2');
                            }
                        });
                    } else { //失败
                        myc.alert({
                            msg: rep.error_msg
                        });

                    }
                },
                error: function () {
                    myc.alert({
                        msg: '网络错误,请刷新页面'
                    });
                },
                complete: function () {
                    myc.hideProgress();
                }
            });
        }

    });

    //绑定手机号码
    $('.loginBtn').click(function (e) {
        if (!$('#phone').val()) {
            myc.alert({
                msg: '请输入手机号码'
            });
            return false;
        }
        if (!myc.regularPhoneNumber($('#phone').val())) {
            myc.alert({
                msg: '输入手机号码格式不对'
            });
            return false;
        }
        if (!$('#code').val()) {
            myc.alert({
                msg: '请输入验证码'
            });
            return false;
        }
        myc.showProgress({
            title: '登录中'
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{route('home.login')}}",
            data: {
                phone: $('#phone').val(),
                code: $('#code').val()
            },
            success: function (rep) {
                if (rep.error_code === 0) { //成功
                    e.stopPropagation();
                    $('.loginForm').css('display', 'none');
                } else { //失败
                    myc.alert({
                        msg: rep.error_msg
                    });
                }
            },
            error: function () {
                myc.alert({
                    msg: '网络错误,请刷新页面'
                });
            },
            complete: function () {
                myc.hideProgress();
            }
        });

    });

</script>

{{-- jQuery --}}

        <!-- Scripts -->
<script src="{{ elixir('js/app.js')}}"></script>
<script src="{{ elixir('js/home/swiper.jquery.min.js')}}"></script>
<script src="{{ elixir('js/home/fastclick.js')}}"></script>
<script src="{{ elixir('js/home/spin.min.js')}}"></script>
<script src="{{ elixir('js/home/iosOverlay.js')}}"></script>
<script src="{{ elixir('js/home/goods.js')}}"></script>
</body>
</html>
