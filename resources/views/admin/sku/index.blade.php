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
                            <th>名称</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($skus as $sku)
                            <tr>
                                <td>{{$sku->name}}</td>
                                <td data-id="{{$sku->id}}">
                                    <div class="btn-group">
                                        <button type="button" class="create btn btn-success">添加子类
                                        </button>
                                        <button type="button" class="btn btn-warning edit">编辑</button>
                                        <button type="button" class="btn btn-danger delete">
                                            删除
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @if(!empty($sku->childs))
                                @foreach ($sku->childs as $sku)
                                    <tr>
                                        <td>|——{{$sku->name}}</td>
                                        <td data-id="{{$sku->id}}">
                                            <div class="btn-group">
                                                <button type="button" class="create btn btn-success">添加子类
                                                </button>
                                                <button type="button" class="btn btn-warning edit">编辑</button>
                                                <button type="button" class="btn btn-danger delete">
                                                    删除
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @if(!empty($sku->childs))
                                        @foreach ($sku->childs as $sku)
                                            <tr>
                                                <td>|————{{$sku->name}}</td>
                                                <td data-id="{{$sku->id}}">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-warning edit">编辑</button>
                                                        <button type="button" class="btn btn-danger delete">
                                                            删除
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
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
        $(".create").click(function () {
            show_stack_info('Creating Sku...');
            var id = $(this).closest("td").attr("data-id");
            if (id === undefined) {
                id = 0;
            }
            location.href = '/admin/sku/create?pid=' + id;
        });
        $(".edit").click(function () {
            var id = $(this).closest("td").attr("data-id");
            if (id === undefined) {
                id = 0;
            }
            location.href = '/admin/sku/' + id+'/edit';
        });
        $(".delete").click(function () {
            var id = $(this).closest("td").attr("data-id");
            swal({
                title: '你确认码?',
                text: '您将无法恢复此SKU!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '确认!',
                cancelButtonText: '取消'
            }).then(function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/admin/sku/" + id,
                    type: 'POST',
                    data: {
                        _method: 'delete'
                    },
                    success: function (response) {
                        if (response.error_code == 0) {
                            swal(
                                    'Deleted!',
                                    'Your sku has been deleted.',
                                    'success'
                            ).then(
                                    function () {
                                        location.reload()

                                    }
                            );
                        } else {
                            show_stack_error('Failed to delete sku', response);
                        }
                    }, error: function () {
                        show_stack_error();
                    }
                });
            }, function (dismiss) {
                // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                if (dismiss === 'cancel') {
                    swal(
                            'Cancelled',
                            'Your sku is safe :)',
                            'error'
                    );
                }
            });
        });
    </script>
@endsection