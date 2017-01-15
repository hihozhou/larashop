@extends('admin.layouts.app')

@section('content')

    <section class="content">
        <div>
            <h1>Sku管理</h1>
            <button type="button" class="create btn btn-lg btn-primary btn-flat">
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
                            <th>图片</th>
                            <th>商品名称</th>
                            <th>是否上架</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($goodsList as $goods)
                            <tr>
                                <td>{{$goods->id}}</td>
                                <td>
                                    <img src="{{$goods->banner_src->url}}" width="60px" height="60px">
                                </td>
                                <td>{{$goods->name}}</td>
                                <td data-id="{{$goods->id}}">
                                    @if($goods->is_sale==1)
                                        <font color="green">上架</font> /
                                        <button href="javascript:void(0)" class="is_sale" data-val="0">下架</button>
                                    @else
                                        <button href="javascript:void(0)" class="is_sale" data-val="1">上架</button> /
                                        <font color="red">下架</font>
                                    @endif
                                </td>
                                <td>{{$goods->created_at}}</td>
                                <td data-id="{{$goods->id}}">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning edit">编辑</button>
                                        <button type="button" class="btn btn-danger delete">
                                            删除
                                        </button>
                                    </div>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>


                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        $(".edit").click(function () {
            var id = $(this).closest("td").attr("data-id");
            if (id === undefined) {
                id = 0;
            }
            location.href = '/admin/goods/' + id + '/edit';
        });
    </script>
@endsection