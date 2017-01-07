<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Styles -->
    <link href="{{ elixir('css/admin/app.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>


</head>
<body class="skin-blue sidebar-mini">
{{--<div id="app">--}}
{{--@if ($headerNeed)--}}
<header class="main-header">
    <a href="#" class="logo">
        <!-- LOGO -->

        <!-- ZH : 设置隐藏菜单栏的字体 -->
        <!-- EN : mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>MS</span>
        <!-- ZH : 正常状态显示logo -->
        <!-- EN : logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Laravel</b>CMS</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="{{ URL::asset('/resources/img/user2-160x160.jpg')}}"
                                                 class="img-circle"
                                                 alt="User Image">
                                        </div>
                                        <h4>
                                            Sender Name
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Message Excerpt</p>
                                    </a>
                                </li><!-- end message -->
                                ...
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="ion ion-ios-people info"></i> Notification title
                                    </a>
                                </li>
                                ...
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                 role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                 aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                                ...
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ URL::asset('/resources/img/user2-160x160.jpg')}}" class="user-image"
                             alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ URL::asset('/resources/img/user2-160x160.jpg')}}" class="img-circle"
                                 alt="User Image">
                            <p>
                                {{ Auth::user()->name }} - Web Developer
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat">Log out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>


</header>
@include('admin.layouts.sidebar')
{{--@else--}}
{{--不需要菜单header--}}
{{--@endif--}}


        <!-- Content Wrapper. Contains page content -->
<div id="app">
    <div class="content-wrapper">
        @yield('content')
    </div>
</div>
{{--</div>--}}

{{-- jQuery --}}
<script src="{{ elixir('js/admin/jquery-2.2.0.min.js')}}"></script>
{{-- pnotify --}}
<script src="{{ elixir('js/admin/pnotify.js')}}"></script>
<script src="{{ elixir('js/admin/pnotify.buttons.js')}}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.0.0/pnotify.js"></script>--}}
{{--<script src="//cdn.bootcss.com/pnotify/3.0.0/pnotify.buttons.js"></script>--}}

{{-- Sweetalert --}}
<script src="https://cdn.jsdelivr.net/sweetalert2/4.0.5/sweetalert2.min.js"></script>

<!-- Scripts -->
<script src="{{ elixir('js/admin/app.js') }}"></script>
{{--<script src="/js/app.js"></script>--}}
<script type="text/javascript">
    var stack_bottomright = { "dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25 };
    function show_stack_success(msg, response) {
        var opts = {
            title: '',
            text: '',
            addclass: "stack-bottomright",
            stack: stack_bottomright,
            hide: true,
            delay: 5000,
            closer: true

        }
        if (msg === undefined) {
            opts.title = "Over Here";
            opts.text = "Everything worked.";
            opts.type = "success";
            opts.addclass = "stack-bottomright";
            opts.stack = stack_bottomright
        } else {
            opts.title = msg;
            opts.text = 'Success!';
            opts.type = "success";
        }
        new PNotify(opts);
    }

    function show_stack_error(msg, response) {

        var opts = {
            title: '',
            text: '',
            addclass: "stack-bottomright",
            stack: stack_bottomright,
            hide: true,
            delay: 5000,
            closer: true
        };
        if (msg === undefined) {
            opts.title = "Failed action";
            opts.text = "Something broke.";
            opts.type = "error";
            opts.addclass = "stack-bottomright";
            opts.stack = stack_bottomright
        } else {
            opts.title = msg;
            opts.text = response.error_msg;
            opts.type = "error";
        }
        new PNotify(opts);
    }

    function show_stack_info(msg, response) {

        var opts = {
            title: '',
            text: '',
            addclass: "stack-bottomright",
            stack: stack_bottomright,
            hide: true,
            delay: 5000,
            closer: true
        }
        if (msg === undefined) {
            opts.title = "Notice me";
            opts.text = "All in order.";
            opts.type = "info";
            opts.addclass = "stack-bottomright";
            opts.stack = stack_bottomright
        } else {
            opts.title = msg;
            opts.text = 'Everything in order';
            opts.type = "info"
        }
        new PNotify(opts);
    }



    PNotify.prototype.options.styling = "fontawesome";
</script>
@yield('script')
</body>
</html>
