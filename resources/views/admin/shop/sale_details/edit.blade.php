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
                                <label class="col-sm-1 control-label">促销期</label>
                                <div class="col-sm-11">
                                    <select id="discount_sale_id" class="form-control select2" style="width: 100%;"
                                            disabled>
                                        <option value="0">请选择</option>
                                        @foreach($salesList as $sales)
                                            <option value="{{$sales->id}}"
                                                    @if($detail->discount_sale_id==$sales->id) selected @endif>{{$sales->id}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">商品详情</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" id="goods_detail_id" placeholder="商品详情id"
                                           value="{{$detail->goods_detail_id}}" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">折扣</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" id="discount" placeholder="折扣"
                                           value="{{$detail->discount}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">是否销售</label>
                                <div class="col-sm-11 btn-group clearfix" data-toggle="buttons">
                                    <label class="btn btn-warning @if($detail->is_sale==1) active @endif">
                                        <input name="isSale" type="radio" id="allow_1" autocomplete="off"
                                               value="1" @if($detail->is_sale==1) checked @endif>
                                        上架
                                    </label>
                                    <label class="btn btn-warning @if($detail->is_sale==0) active @endif">
                                        <input name="isSale" type="radio" id="allow_0" autocomplete="off"
                                               value="0" @if($detail->is_sale==0) checked @endif
                                        > 下架
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">库存</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" id="stock" placeholder="库存"
                                           value="{{$detail->stock}}">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-flat btn-info pull-right" id="save"
                                    data-save-url="{{action('Admin\DiscountSaleDetailsController@update',['id'=>$detail->id])}}">
                                保存
                            </button>
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
        $("#save").click(function () {
            var url = $(this).attr('data-save-url');
            var data = {
                discount_sale_id: $('#discount_sale_id').val(),
                goods_detail_id: $('#goods_detail_id').val(),
                discount: $('#discount').val(),
                is_sale: $(":radio[name='isSale']:checked").val(),
                stock: $("#stock").val()
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'put',
                data: data,
                success: function (response) {
                    if (response.error_code === 0) {
                        show_stack_success('修改成功', response);
                        window.location.reload();
                    } else {
                        show_stack_error('修改失败', response);
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