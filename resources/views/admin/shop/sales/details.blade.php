@extends('admin.layouts.app')

@section('css')
    <link href="{{ elixir('css/admin/daterangepicker.css')}}" rel="stylesheet">
@endsection

@section('content')

    <section class="content">
        <div>
            <h1>特卖内容管理</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading input-group date">
                        <div class="input-group-addon">
                            <span>选择活动期</span>
                        </div>
                        <select id="discount_sales_id" class="form-control select2" style="width: 100%;">
                            @foreach($salesList as $sales)
                                <option value="{{$sales->id}}"
                                        @if($sales->id==$id)  selected="selected" @endif>{{$sales->id}}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>图片</th>
                            <th>商品名称</th>
                            <th>优惠</th>
                            <th>库存</th>
                            <th>是否上架</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>{{$detail->id}}</td>
                                <td>
                                    <img src="{{\App\Models\Image::baseUrl($detail->goods_detail->image_src->name)}}"
                                         width="60px" height="60px">
                                </td>
                                <td>
                                    {{$detail->goods_detail->goods->name}}<br/>
                                    @foreach($detail->goods_detail->skus as $sku)
                                        -{{$sku->sku->name}}
                                    @endforeach

                                </td>
                                <td>{{$detail->discount}}</td>
                                <td>{{$detail->stock}}</td>
                                <td data-id="{{$detail->id}}">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success is_sale" data-val="1"
                                                @if($detail->is_sale==1) disabled @endif>上架
                                        </button>
                                        <button type="button" class="btn btn-danger is_sale" data-val="0"
                                                @if($detail->is_sale==0) disabled @endif>下架
                                        </button>
                                    </div>
                                </td>
                                <td>{{$detail->created_at}}</td>
                                <td data-id="{{$detail->id}}"
                                    data-edit-url="{{action('Admin\DiscountSaleDetailsController@edit',['id'=>$detail->id])}}"
                                    data-delete-url="{{action('Admin\DiscountSaleDetailsController@destroy',['id'=>$detail->id])}}">
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
        $('#discount_sales_id').change(function () {
//            alert($(this).val());
            window.location.href = '/admin/sales/' + $(this).val() + '/details';
        });
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
            var url = $(this).closest("td").attr("data-edit-url");
            window.location.href = url;
        });
        $(".delete").click(function () {
            var url = $(this).closest("td").attr("data-delete-url");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'delete',
                data: {
                    is_sale: $(this).attr("data-val")
                },
                success: function (response) {
                    if (response.error_code == 0) {
                        show_stack_success('删除成功', response);
                        window.location.reload();
                    } else {
                        show_stack_error('删除失败', response);
                    }
                }, error: function () {
                    show_stack_error();
                }
            });
        });

        $(".is_sale").click(function () {
            var id = $(this).closest("td").attr("data-id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/sale_details/" + id + '/sell',
                type: 'PUT',
                data: {
                    is_sale: $(this).attr("data-val")
                },
                success: function (response) {
                    if (response.error_code == 0) {
                        show_stack_success('售卖状态更改成功', response);
                        window.location.reload();
                    } else {
                        show_stack_error('售卖状态更改失败', response);
                    }
                }, error: function () {
                    show_stack_error();
                }
            });
        });

    </script>
@endsection