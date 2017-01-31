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
    <link rel="stylesheet" href="{{ elixir('css/home/login.css')}}"/>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <style>
        .pic {
            width: 100%;
        }

        .numQuery {
            width: 100%;
        }

        .numQuery p {
            position: relative;
            padding: 0 4%;
            border-bottom: 1px solid #e4e4e4;
        }

        .numQuery p span {
            font-size: 15px;
            color: #333;
            display: inline-block;
            vertical-align: middle;
        }

        .numQuery p input {
            display: inline-block;
            vertical-align: middle;
            font-size: 15px;
            font-family: "microsoft yahei";
            color: #333;
            border-style: none;
            padding: 5.5% 0;
            background: none;
            text-indent: 1em;
            width: 85%;
        }

        .numQuery p input::-webkit-input-placeholder {
            color: #999;
            font-family: "microsoft yahei";
        }

        .numQuery p a {
            position: absolute;
            right: 4%;
            background-color: #ffda44;
            padding: 2.6%;
            font-size: 15px;
            color: #333;
            border-radius: 5px;
            top: 50%;
            transform: translate3d(0, -50%, 0);
            -webkit-transform: translate3d(0, -50%, 0);
            width: 80px;
            text-align: center;
        }

        .numQuery p a i {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: none;
        }

        a.login {
            width: 90%;
            display: block;
            margin: 15% auto 0;
            font-size: 18px;
            color: #333;
            background-color: #ffda44;
            padding: 4% 0;
            text-align: center;
            border-radius: 7px;
            letter-spacing: 1px;
        }

    </style>

</head>


<body class="skin-blue sidebar-mini">

<!-- 头部海报 开始 -->
<div class="pic" style="background-color: #ffda44;">
    <img src="{{elixir('images/home/order_query.png')}}">
</div>
<!-- 头部海报 结束 -->

<!-- 号码查询 开始 -->
<div class="numQuery">
    <p>
        <span>手机号</span>
        <input type="tel" placeholder="请输入登录手机号" id="phone">
        <a href="javascript:void(0);" id="getCode"><span>获取验证码</span></a>
    </p>
    <p>
        <span>验证码</span>
        <input type="text" placeholder="请输入验证码" id="code">
    </p>
</div>
<!-- 号码查询 结束 -->

<a href="javascript:void(0);" class="login" id="login">登录</a>

{{-- jQuery --}}
{{--TODO --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
<script src="{{ elixir('js/home/myc.js')}}"></script>
<!-- Scripts -->
{{--<script src="{{ elixir('js/admin/app.js') }}"></script>--}}
{{--<script src="/js/app.js"></script>--}}

<script>

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
                                getCode.css('backgroundColor', '#ffda44');
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
    $('.login').click(function (e) {
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
                    window.location.href = '{!! route('home.user.index') !!}';
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

</body>
</html>
