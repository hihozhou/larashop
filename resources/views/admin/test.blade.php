@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}
    {{--<div class="row">--}}
    {{--<div class="col-md-8 col-md-offset-2">--}}
    {{--<div class="panel panel-default">--}}
    {{--<div class="panel-heading">Dashboard</div>--}}

    {{--<div class="panel-body">--}}
    {{--You are logged in!--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    <div id="app">
        <div class="content-wrapper">

            <section class="content">
                <div>
                    <h1>Sku管理</h1>
                    <button class="btn btn-success">
                        添加Sku
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading">Panel heading</div>

                            <!-- Table -->
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>角色</th>
                                    <th>角色名称</th>
                                    <th>角色描述</th>
                                    <th>创建时间</th>
                                    <th>更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>

                                <tr>
                                    <td>1</td>
                                    <td>
                                        1
                                    </td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>
                                        1

                                    </td>
                                    <td>
                                        未知
                                    </td>
                                    <td>
                                        用户列表
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        1
                                    </td>
                                    <td>1</td>
                                    <td>1</td>
                                    <td>
                                        1

                                    </td>
                                    <td>
                                        未知
                                    </td>
                                    <td>
                                        用户列表
                                    </td>
                                </tr>
                            </table>



                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    {{--<example></example>--}}
@endsection