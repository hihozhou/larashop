<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        {{--<div class="user-panel">--}}
        {{--<div class="pull-left image">--}}
        {{--<img src="{{ URL::asset('/resources/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">--}}
        {{--</div>--}}
        {{--<div class="pull-left info">--}}
        {{--<p>{{ Auth::user()->name }}</p>--}}
        {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
        {{--</div>--}}
        {{--</div>--}}
                <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>商城管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/admin/sku"><i class="fa fa-circle-o"></i>商品sku</a></li>
                    <li><a href="/admin/goods/create"><i class="fa fa-circle-o"></i> 添加商品</a></li>
                    <li><a href="/admin/goods"><i class="fa fa-circle-o"></i> 商品列表</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                    <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                    <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                    <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed
                            Sidebar</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                    <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                    <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                    <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                    <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                    <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                    <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                    <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                </ul>
            </li>
            {{--@endif--}}

            {{--@endforeach--}}
            {{--@foreach ($menus as $menu)--}}
            {{--@if ($menu->type == 'view')--}}
            {{--<li class="@if (Request::route()->getName()==$menu->uri_name) active @endif">--}}
            {{--<a href="{{URL::route($menu->uri_name)}}">--}}
            {{--<i class="fa {{$menu->icon}} "></i>--}}
            {{--<span>{{$menu->desc}}</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<small class="label pull-right bg-green">new</small>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--@elseif ($menu->type=='module')--}}
            {{--<li class="treeview @if ($menu->childs->contains('uri_name', Request::route()->getName())) active @endif">--}}
            {{--<a href="#">--}}
            {{--<i class="fa {{$menu->icon}}"></i> <span>{{$menu->desc}}</span>--}}
            {{--<span class="pull-right-container">--}}
            {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--@foreach ($menu->childs as $child)--}}
            {{--@if ($child->type == 'view')--}}
            {{--<li class="@if (Request::route()->getName()==$child->uri_name) active @endif"><a href="{{URL::route($child->uri_name)}}"><i class="fa {{$child->icon}}"></i> {{$child->desc}}</a></li>--}}
            {{--@endif--}}
            {{--@endforeach--}}
            {{--<li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--@else--}}
            {{--I don't have any records!--}}
            {{--@endif--}}

            {{--@endforeach--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>