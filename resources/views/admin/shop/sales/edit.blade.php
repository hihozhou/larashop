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
                            <input type="hidden" value="{{$sales->id}}" id="id">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">时间段</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" id="sold_at" placeholder="时间段"
                                           value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">是否销售</label>
                                <div class="col-sm-11 btn-group clearfix" data-toggle="buttons">
                                    <label class="btn btn-warning @if($sales->is_sale==1)active @endif">
                                        <input name="isSale" type="radio" id="allow_1" autocomplete="off"
                                               value="1" @if($sales->is_sale==1)checked @endif>
                                        上架
                                    </label>
                                    <label class="btn btn-warning @if($sales->is_sale==0)active @endif">
                                        <input name="isSale" type="radio" id="allow_0" autocomplete="off"
                                               value="0" @if($sales->is_sale==0)checked @endif
                                        > 下架
                                    </label>
                                </div>
                            </div>

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
        $('#sold_at').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            startDate: '{!! $sales->began_at !!}',
            endDate: '{!! $sales->ended_at !!}',
            locale: {format: 'YYYY/MM/DD H:mm'},
            timePicker24Hour: true
        });
        $("#save").click(function () {
            var rangeArr = $("#sold_at").val().split(' - ');
            console.log(rangeArr);
            var began_at = rangeArr[0];
            var ended_at = rangeArr[1];
            var data = {
                began_at: began_at,
                ended_at: ended_at,
                is_sale: $(":radio[name='isSale']:checked").val()
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/sales/" + $('#id').val(),
                type: 'PUT',
                data: data,
                success: function (response) {
                    if (response.error_code === 0) {
                        show_stack_success('更新称该', response);
                        window.location = '/admin/sales';
                    } else {
                        show_stack_error('更新失败', response);
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