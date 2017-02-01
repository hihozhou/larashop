@extends('admin.layouts.app')

@section('css')
    <link href="{{ elixir('css/admin/daterangepicker.css')}}" rel="stylesheet">
@endsection

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">特卖创建</h3>
                    </div>
                    <form class="form-horizontal" onsubmit="return false">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">商品详情</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" id="goods_detail_id" placeholder="商品详情id"
                                           value="{{Request::input('goods_detail_id',0)}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">折扣</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" id="discount" placeholder="折扣"
                                           value="0.00">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">是否销售</label>
                                <div class="col-sm-11 btn-group clearfix" data-toggle="buttons">
                                    <label class="btn btn-warning active">
                                        <input name="isSale" type="radio" id="allow_1" autocomplete="off"
                                               value="1" checked>
                                        上架
                                    </label>
                                    <label class="btn btn-warning">
                                        <input name="isSale" type="radio" id="allow_0" autocomplete="off"
                                               value="0"
                                        > 下架
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">库存</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" id="stock" placeholder="库存"
                                           value="0">
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<label class="col-sm-1 control-label">开始时间</label>--}}
                            {{--<div class="col-sm-11">--}}
                            {{--<input type="text" class="form-control" id="began_at" placeholder="开始时间"--}}
                            {{--value="">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                            {{--<label class="col-sm-1 control-label">结束时间</label>--}}
                            {{--<div class="col-sm-11">--}}
                            {{--<input type="text" class="form-control" id="ended_at" placeholder="结束时间"--}}
                            {{--value="">--}}
                            {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-flat btn-info pull-right" id="save">保存</button>
                            <button class="btn btn-flat btn-danger" id="cancel">取消</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        //Date range picker with time picker
        //        $('#began_at').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //        $('#ended_at').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});

        $("#save").click(function () {

            var data = {
                goods_detail_id: $('#goods_detail_id').val(),
                discount: $('#discount').val(),
                is_sale: $(":radio[name='isSale']:checked").val(),
                stock: $("#stock").val()
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/sales",
                type: 'post',
                data: data,
                success: function (response) {
                    if (response.error_code == 0) {
                        show_stack_success('Sku saved', response);
                        window.location = '/admin/sales';
                    } else {
                        show_stack_error('Failed to save sku', response);
                    }
                }, error: function () {
                    show_stack_error();
                }
            });
        });
        $("#cancel").click(function () {
            history.back();
        });
    </script>
@endsection