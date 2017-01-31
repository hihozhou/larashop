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
    <link rel="stylesheet" href="{{ elixir('css/home/select.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/home/iosOverlay.css')}}"/>
    <link rel="stylesheet" href="{{ elixir('css/home/select_address.css')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>

<body class="clearfix">

@foreach($addresses as $key=>$address)
    <a href="javascript:void(0)" class="address_list col-xs-12" data-id="{{$address->id}}">
        <span class="check_radio @if($key==0 && $address->used_at!=null) active @endif">
        </span>
        <span class="col-xs-12">
            <span class="col-xs-12 address_title">
                <strong class="detail_name">
                    {{$address->consignee}}
                </strong>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <span class="detail_phone">
                    {{$address->phone}}
                </span>
            </span>
            <span class="col-xs-12 address_detail">
                    <span class="province_add">{{$address->province}}</span>
                    <span class="city_add">{{$address->city}}</span>
                    <span class="district_add">{{$address->district}}</span>
                    <span class="detail_add">
                    {{$address->address}}
                    </span>
            </span>

		</span>
        <span class="red_edit edit">

        </span>
    </a>
@endforeach

<a href="javascript:void(0)" class="btn btn-warning btn-sm" id="btn_confirm">
    确定
</a>

<a href="javascript:void(0)" class="btn btn-default btn-sm add" id="add_address"
   style="width:90%;margin-left: 5%;font-size: 14px;">
    + 新增地址
</a>

<form action="{{route('home.order.store')}}" method="post" id="form">
    <input type="hidden" name="orderSn"/>
</form>


<div class="address_pop" style="">
    <div class="adddress_list">
        <div class="popAddress">
            <p class="clearfix popLine" style="padding-left: 56px;">
                    <span class="popLineLeft">
                         收货人：
                    </span>
                     <span class="popLineRight">
                        <input type="text" class="input pull-left pop_name" name="pop_name" placeholder="请填写收货人姓名"/>
                     </span>
            </p>
            <p class="clearfix popLine" style="padding-left: 56px;">
                    <span class="popLineLeft">
                         手机号：
                    </span>
                     <span class="popLineRight">
                        <input type="text" class="input pull-left pop_phone" name="pop_phone" placeholder="请填写手机号码"/>
                     </span>
            </p>
            <!--<p class="clearfix popLine" style="padding-left: 56px;">
               <span class="popLineLeft">
                    省市区：
               </span>
                <span class="popLineRight">
                   <input type="text" class="input pull-left pop_pcd" name="pop_pcd"  placeholder="请填写省市区"/>
                </span>
            </p>-->
            <div class="clearfix popLine" style="padding-left: 56px;">
                    <span class="popLineLeft">
                        地址
                    </span>
                <div class="popLineRight clearfix">
                    <div class="col-xs-6 pr10">
                        <div class="button custom-select ff-hack col-xs-12">
                            <select class="col-xs-12" id="s_province">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6 pl10">
                        <div class="button custom-select ff-hack  col-xs-12">
                            <select class="col-xs-12" id="s_city">
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12" style="margin:10px 0px;">
                        <div class="button custom-select ff-hack col-xs-12">
                            <select class="col-xs-12" id="s_county">
                            </select>
                        </div>
                    </div>
                </div>


            </div>

            <p class="clearfix popLine" style="padding-left: 66px;">
                    <span class="popLineLeft">
                         详细地址：
                    </span>
                     <span class="popLineRight">
                        <input type="text" class="input pull-left pop_address" name="pop_address"
                               placeholder="请填写详细地址"/>
                     </span>
            </p>
        </div>
        <button class="btn btn-warning save">
            保存
        </button>
        <button class="btn btn-default cancel">
            取消
        </button>
    </div>

</div>


{{-- jQuery --}}
{{--TODO --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
<script>
    var url = '{!! route('home.order.store') !!}';
    var loading_url = '/images/home/';
    var add_url = '{!! route('home.address.store') !!}';
    var edit_url = '/';
</script>


<!-- Scripts -->
<script src="{{ elixir('js/app.js')}}"></script>
<script src="{{ elixir('js/home/fastclick.js')}}"></script>
<script src="{{ elixir('js/home/area.js')}}"></script>
<script src="{{ elixir('js/home/spin.min.js')}}"></script>
<script src="{{ elixir('js/home/iosOverlay.js')}}"></script>
<script src="{{ elixir('js/home/select_address.js')}}"></script>
</body>
</html>
