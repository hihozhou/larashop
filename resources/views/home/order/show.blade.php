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
    <link rel="stylesheet" href="{{ elixir('css/home/order_show.css')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        .falut_img_container {
            width: 100%;
        }

        .falut_img_container:after {
            content: "";
            display: block;
            clear: both;
            height: 0;
            line-height: 0;
            visibility: hidden;
        }

        .falut_img_container > span, .falut_img_container > img {
            display: inline-block;
            vertical-align: middle;
            width: 50px;
            height: 50px;
            line-height: 50px;
            float: left;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .falut_img_container > span {
            width: 80px;
            border: none;
            color: #999;
        }
    </style>

</head>

<body style="color:#555;">
<!-- 订单详情 开始 -->
<div class="e_wrap">
    <dl class="clearfix">
        <dt>
            <img src="{{elixir('images/home/express.jpg')}}">

        </dt>
        <dd>
            <!--<h2 class="e_h2">{$aData.tips}</h2>-->
            <p class="e_p">订单提交</p>
        </dd>

    </dl>

    <div class="e_enter">
        <a href="javascript:void(0);" style="width: 20%">
            <span @if($order->status==1) class="active" @endif ></span>
            <span>订单提交</span>
        </a>
        <a href="javascript:void(0);" style="width: 20%">
            <span @if($order->status==2) class="active" @endif ></span>
            <span>商品出库</span>
        </a>
        <a href="javascript:void(0);" style="width: 20%">
            <span @if($order->status==3) class="active" @endif ></span>
            <span>等待收货</span>
        </a>
        <a href="javascript:void(0);" style="width: 20%">
            <span @if($order->status==5) class="active" @endif ></span>
            <span>完成订单</span>
        </a>
    </div>

</div>

<!-- 地址信息 -->
<div class="e_header e_header1" style="display:block">
    <p>
        <span>{{$order->consignee}}</span>
        <span>{{$order->phone}}</span>
    </p>
    <p>
        <img src="{{elixir('images/home/location.png')}}">
        <span>{{$order->province}}{{$order->city}}{{$order->district}}{{$order->address}}</span>
    </p>
</div>

@foreach($order->details as $detail)
    <ul class="e_ulList e_ulList1">
        <li id="falut_3" class="falut_img_container">
            <span>商品图片：</span>
            <img src="{{\App\Models\Image::baseUrl($detail->goods_detail->image_src->name)}}"
                 onclick="openFalutImg(this)"/>
        </li>
        <li class="clearfix">
            <span>商品信息：</span>
            <span>
                {{$detail->goods_detail->goods->name}}
                @foreach($detail->goods_detail->skus as $sku)
                    {{$sku->sku->name}}
                @endforeach
            </span>
        </li>
        <li class="clearfix">
            <span>数量：</span>
            <p>
                <span>x{{$detail->num}}</span>
                <span>￥{{$detail->price}}</span>
            </p>
        </li>
        {{--<li class="clearfix">--}}
        {{--<span>合计：</span>--}}
        {{--<p>--}}
        {{--<span>￥{{$detail->total_price}}</span>--}}
        {{--</p>--}}
        {{--</li>--}}
        <li id="falut_2" style="color: #007AFF;text-align: center;">
            <a href="{{route('home.goods.show',['id'=>$detail->goods_detail->goods_id])}}"
               style="color: #007AFF">查看商品信息</a>
        </li>

    </ul>
@endforeach

<ul class="e_ulList e_ulList1">
    <li class="clearfix">
        <span>下单时间:</span>
        <span>{{$order->created_at}}</span>
    </li>
    <li class="clearfix">
        <span>总价:</span>
        <span style="color: #ff9901;">￥{{$order->total_price}}</span>
    </li>
    <li class="clearfix">
        <span>优惠:</span>
        <span style="color: #ff9901;">-￥{{$order->discount}}</span>
    </li>
    <li class="clearfix">
        <span>共计:</span>
        <span style="color: #ff9901;">￥{{number_format($order->total_price-$order->discount,2)}}</span>
    </li>
</ul>

<div class="e_aBtn">
    @if($order->status>=0)
        <a href="javascript:order_cancel('{{route('home.order.cancel',['sn'=>$order->sn])}}');" class="order_cancel"
        >取消订单</a>
    @elseif($order->status==-1)
        <a href="javascript:return false;" class="order_cancel" style="color: #adadad;border: 2px solid #adadad;"
        >取消申请中</a>
    @else
        <a href="javascript:return false;" class="order_cancel"
           style="color: #adadad;border: 2px solid #adadad;">订单已取消</a>
    @endif

</div>

{{-- jQuery --}}
{{--TODO --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
<script src="{{ elixir('js/home/myc.js')}}"></script>
<script>
    function order_cancel($url) {
        myc.showProgress({
            title: '申请提交中'
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "delete",
            url: $url,
            data: {},
            success: function (rep) {
                if (rep.error_code === 0) { //成功
                    myc.toast({
                        msg: '申请成功'
                    });
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);


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

</script>


<!-- Scripts -->
<script src="{{ elixir('js/app.js')}}"></script>
<script src="{{ elixir('js/home/fastclick.js')}}"></script>
<script src="{{ elixir('js/home/spin.min.js')}}"></script>
<script src="{{ elixir('js/home/iosOverlay.js')}}"></script>
</body>
</html>
