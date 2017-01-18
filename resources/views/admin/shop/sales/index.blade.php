@extends('admin.layouts.app')

@section('css')
    <link href="{{ elixir('css/admin/daterangepicker.css')}}" rel="stylesheet">
@endsection

@section('content')

    <section class="content">
        <div>
            <h1>特卖管理</h1>
            <button type="button" class="create btn btn-lg btn-primary btn-flat">
                添加
            </button>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="hidden" id="began_at" value="{{\App\Models\GoodsSales::getSoldBeganAt()}}"/>
                        <input type="hidden" id="ended_at" value="{{\App\Models\GoodsSales::getSoldEndedAt()}}"/>
                        <input type="text" class="form-control" id="sold_at" placeholder="开始时间"
                               value="">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat" id="sold_save">Go!</button>
                        </span>
                    </div>

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
                        @foreach ($salesList as $sales)
                            <tr>
                                <td>{{$sales->id}}</td>
                                <td>
                                    <img src="{{\App\Models\Image::baseUrl($sales->detail->image_src->name)}}" width="60px" height="60px">
                                </td>
                                <td>
                                    {{$sales->detail->goods->name}}<br/>
                                    @foreach($sales->detail->skus as $sku)
                                    -{{$sku->sku->name}}
                                    @endforeach

                                </td>
                                <td data-id="{{$sales->id}}">
                                    @if($sales->is_sale==1)
                                        <font color="green">上架</font> /
                                        <button href="javascript:void(0)" class="is_sale" data-val="0">下架</button>
                                    @else
                                        <button href="javascript:void(0)" class="is_sale" data-val="1">上架</button> /
                                        <font color="red">下架</font>
                                    @endif
                                </td>
                                <td>{{$sales->created_at}}</td>
                                <td data-id="{{$sales->id}}">
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
        $('#sold_at').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            startDate: $('#began_at').val(),
            endDate: $('#ended_at').val(),
            locale: {format: 'YYYY/MM/DD H:mm'},
            timePicker24Hour: true
        });
        $('#sold_save').click(function () {
            var rangeArr = $("#sold_at").val().split(' - ');
            console.log(rangeArr);
            var began_at = rangeArr[0];
            var ended_at = rangeArr[1];
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/sales/time/update",
                type: 'post',
                data: {
                    began_at: began_at,
                    ended_at: ended_at
                },
                success: function (response) {
                    if (response.error_code == 0) {
                        show_stack_success('时间更新成功', response);
                    } else {
                        show_stack_error('时间更新失败', response);
                    }
                }, error: function () {
                    show_stack_error();
                }
            });
        });
        $(".edit").click(function () {
            var id = $(this).closest("td").attr("data-id");
            if (id === undefined) {
                id = 0;
            }
            location.href = '/admin/sales/' + id + '/edit';
        });
    </script>
@endsection