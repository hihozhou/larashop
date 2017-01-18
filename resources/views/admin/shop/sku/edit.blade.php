@extends('admin.layouts.app')

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">sku编辑</h3>
                    </div>
                    <form class="form-horizontal" onsubmit="return false">
                        <input type="hidden" id="id" value="{{$sku->id}}"/>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-1 control-label">父级id</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" id="pid" placeholder="父级id"
                                           value="{{$sku->pid}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-1 control-label">名称</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" id="name" placeholder="sku名称"
                                           value="{{$sku->name}}">
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
        $("#save").click(function () {
            var id = $("#id").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/sku/" + id,
                type: 'PATCH',
                data: {
                    name: $("#name").val(),
                    pid: $("#pid").val()
                },
                success: function (response) {
                    if (response.error_code == 0) {
                        show_stack_success('Sku saved', response);
                        window.location = '/admin/sku';
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