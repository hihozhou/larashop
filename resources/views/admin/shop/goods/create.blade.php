@extends('admin.layouts.app')
@section('css')
    <style>
        #xw_loader {
            width: 50px;
            height: 50px;
            position: fixed;
            left: 50%;
            top: 50%;
            margin-left: -25px;
            margin-top: -25px;
            z-index: 9999;
        }

        .edui-container {
            margin: auto;
        }

        .form_bar label {
            cursor: pointer;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .skuImg {
            display: block;
            position: relative;
            width: 100px;
            height: 100px;
            overflow: hidden;
            border: 1px dashed #dddddd;
            margin: 0 auto;
        }

        .skuBt {
            border: 1px solid #dddddd;
            white-space: nowrap;
            padding: 3px 3px;
            font-size: 14px;
            line-height: 1.42857143;
            border-radius: 2px;
            background: #F6F6F6;
            margin-bottom: 4px;
            width: 94px;
            text-align: center;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .border {
            border-top: none !important;
        }

        .border-bottom {
            border-bottom: 1px solid #dddddd;
        }

        .item_pic_mom {
            float: left;
            width: 350px;
            height: 350px;
        }

        .item_pic_left {
            float: left;
            width: 290px;
            height: 290px;
            border: 1px solid #D0D0D0;
            margin: 10px;
            background: #F9F9F9;
        }

        .item_pic_right {
            float: left;
            width: 30px;
            height: 23px;
            margin-top: 130px;
            background-color: #F9F9F9;
            text-align: center;
        }

        .item_pic_info {
            color: gray;
        }

        .item_pic_left img {
            width: 100%;
            height: 290px;
        }

        #sku_group input {
            padding-right: 2px;
            padding-left: 2px;
            text-align: center;
        }

        .border {
            border: 1px solid #dddddd;
        }

        .width100 {
            width: 100% !important;
            display: block;

        }

        .upload_wraper {
            position: relative;
            overflow: hidden;
        }

        .input_file {
            display: block;
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            opacity: 0;
            -ms-filter: 'alpha(opacity=0)';
            font-size: 200px;
            direction: ltr;
            cursor: pointer;
            z-index: 1000;
        }

        .p_b_bordered {
            border-bottom: 1px solid #dbdfea;
        }

        .pl20 {
            padding-left: 20px;
        }

        .ico_what {
            cursor: pointer;
            background: url("../images/ico_what.png") no-repeat center center;
            background-size: 18px;
            display: inline-block;
            width: 18px;
            height: 18px;
        }

        .ml10 {
            margin-left: 10px;
        }

        .mt20 {
            margin-top: 20px;
        }

        .pl50 {
            padding-left: 50px;
        }

        .bg_spec {
            background: #eef1f8;
        }

        .padding0 {
            padding: 0px !important;
        }

        .modal {
            text-align: left;
        }

        .modal-huge {
            width: 1000px;
        }

        .margin10 {
            margin: 10px 0px;
        }

        .table td, .table th {
            vertical-align: middle !important;
        }

        .text_center {
            text-align: center;
        }

        .form_bar {
            line-height: 28px;
        }

        .mb10 {
            margin-bottom: 10px;
        }

        .small_text {
            font-size: 12px !important;
        }

        .pr5 {
            padding-right: 5px;
        }

        .tab-content {
            padding: 10px 0px;
        }

        .dash {
            border: 2px dashed #dddddd;
        }

        .text_warning {
            color: #d44950;
        }

        /*图片上传*/
        .upload_wraper {
            overflow: hidden;
            width: 294px;
            height: 294px;
        }


    </style>
@endsection
@section('content')

    <section class="content" id="appContent">
        <div class="row">
            <div class="col-md-12">
                <!--在这里写-->

                <div class="back pull-right clearfix">
                    <a href="javascript:void(0);" class="btn btn-primary" id="save_msg">提交信息</a>
                    {{--<if condition="($arr['goodsID'] gt 0)">--}}
                    {{--<a class="btn btn-default" href="{:U('Houtai/Goods/index')}?sGoodsSn={$Think.request.sGoodsSn}&sGoodsName={$Think.request.sGoodsName}&sCatID={$Think.request.sCatID}&sIsSale={$Think.request.sIsSale}&p={$Think.request.p}" >--}}
                    {{--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 后退--}}
                    {{--</a>--}}
                    {{--</if>--}}

                </div>

                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs clearfix" role="tablist">
                        <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab"
                                                                  data-toggle="tab">基本信息</a></li>
                        <li role="presentation"><a href="#description" aria-controls="description" role="tab"
                                                   data-toggle="tab">参数描述</a></li>
                        <li role="presentation"><a href="#content" aria-controls="content" role="tab" data-toggle="tab">详细描述</a>
                        </li>
                        <li role="presentation"><a href="#skus" aria-controls="skus" role="tab"
                                                   data-toggle="tab">SKU</a></li>
                        <li role="presentation"><a href="#banners" aria-controls="banners" role="tab"
                                                   data-toggle="tab">商品相册</a></li>
                    </ul>
                    <!-- Tab panes start-->
                    <div class="tab-content">
                        <!--基本信息 开始-->
                        <div role="tabpanel" class="tab-pane active" id="basic">
                            <div class="row clearfix">
                                <div class="col-md-12 margin10">
                                    <div class="col-md-2 text_right form_bar">
                                        商品名称：
                                    </div>
                                    <div class="col-md-4">
                                        <input id="name" value="" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-1 text_warning text_left form_bar">
                                        *
                                    </div>
                                </div>


                                <div class="col-md-12 margin10">
                                    <div class="col-md-2 text_right form_bar">
                                        商品编号：
                                    </div>
                                    <div class="col-md-4">
                                        <input id="goodsSn" value="" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-6 text_warning text_left form_bar">
                                        不填写则有系统随机分配
                                    </div>
                                </div>


                                <div class="col-md-12 margin10">
                                    <div class="col-md-2 text_right form_bar">
                                        上架销售：
                                    </div>
                                    <div class="col-md-4">
                                        <div class="btn-group clearfix" data-toggle="buttons">
                                            <label class="btn btn-warning">
                                                <input name="isSale" type="radio" id="allow_1" autocomplete="off"
                                                       value="1" checked>
                                                上架
                                            </label>
                                            <label class="btn btn-warning">
                                                <input name="isSale" type="radio" id="allow_0" autocomplete="off"
                                                       value="0"
                                                       checked
                                                > 下架
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 text_warning text_left form_bar">
                                        *
                                    </div>
                                </div>

                                <div class="col-md-12 margin10">
                                    <div class="col-md-2 text_right form_bar">
                                        商品简述：
                                    </div>
                                    <div class="col-md-6">
                                        <textarea id="desc" class="form-control"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--基本信息结束-->

                        <!--参数描述 开始-->
                        <div role="tabpanel" class="tab-pane" id="description">
                            <textarea id="descriptionText"></textarea>
                        </div>
                        <!--参数描述 结束-->

                        <!--详细信息 开始-->
                        <div role="tabpanel" class="tab-pane" id="content">
                            <textarea id="contentText"></textarea>
                        </div>
                        <!--详细信息 结束-->

                        <!--SKU 开始-->
                        <div role="tabpanel" class="tab-pane" id="skus">
                            <div class="clearfix pl50">
                                <div class=" form_bar pull-left">
                                    商品SKU类型：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="col-xs-4">
                                    <select class="form-control" id="sku_def">
                                        <option value="-1">-请选择SKU-</option>
                                        @foreach($skus as $sku)
                                            <option value="{{$sku->id}}">{{$sku->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="pl50 navbar-default"
                                 style="padding-top:6px;padding-bottom:6px;margin:10px 0px;">
                                请选择该商品所关联的各种属性
                            </div>
                            <div id="sku_checkbox_wrapper" class="clearfix">
                                {{--@foreach($skus as $sku)--}}
                                {{--<div class="pl50 clearfix">--}}
                                {{--<div class=" form_bar col-xs-1 text_right">--}}
                                {{--{{$sku->name}}：&nbsp;&nbsp;--}}
                                {{--</div>--}}
                                {{--<div class="col-xs-11 check_box_line">--}}
                                {{--@foreach($sku->childs as $sku)--}}
                                {{--<div class="col-xs-2 form_bar">--}}
                                {{--<label title="{{$sku->name}}">--}}
                                {{--<input type="checkbox" class="top_checkbox"--}}
                                {{--value="{{$sku->id}}">{{$sku->name}}--}}
                                {{--</label>--}}
                                {{--</div>--}}
                                {{--@endforeach--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--@endforeach--}}
                            </div>
                            <div class="pl50 clearfix">
                                <a href="javascript:void(0);" class="btn btn-primary" id="check_confirm">选好了</a>
                            </div>

                            <div class="pl50 navbar-default border-bottom"
                                 style="padding-top:6px;padding-bottom:6px;margin:30px 0px 0px 0px;">
                                根据以上所选择的属性，共有以下这些组合，请给需要的组合设置价格等信息：
                            </div>
                            <div class="clearfix" id="sku_group">

                            </div>
                        </div>
                        <!--SKU 结束-->
                        <!--相册 开始-->
                        <div role="tabpanel" class="tab-pane" id="banners">

                            <div class="col-md-12 margin10">
                                <div class="col-md-2 text_right form_bar">
                                    <button type="button" id="uploadImg" class="btn btn-primary btn-sm">
                                        上传商品主图
                                    </button>
                                    ：
                                    <input type="hidden" id="banner" value=""/>
                                    {{--<input type="hidden" id="thumbImg" value=""/>--}}
                                </div>
                                <div class="col-md-4">
                                    <div class=" padding0 margin10">
                                        <div class="upload_wraper dash">
                                            <div class="logo_wraper ">
                                                <img id="pic" src=""
                                                     class="width100 img-rounded" alt="">
                                                <input type="file" style="visibility: hidden;" class="input_file"
                                                       id="fileupload" name="file" value="" data-url="" multiple="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1 text_warning text_left form_bar"> *</div>

                            </div>
                            <div class="col-md-12 margin10">
                                <div class="col-md-2 text_right form_bar">
                                    <button type="button" id="uploadSilderImg" class="btn btn-primary btn-sm">
                                        上传商品轮播图
                                    </button>
                                    ：
                                </div>
                                <div class="col-md-10">
                                    <div id="showPicDiv" class=" padding0 margin10">

                                        {{--<volist name="silderArr" id="vo">--}}

                                        {{--<div id="item_{$i - 1}" class="item_pic_mom">--}}
                                        {{--<div class="item_pic_left">--}}
                                        {{--<img style="" src="{$vo}"/>--}}
                                        {{--</div>--}}
                                        {{--<div class="item_pic_right">--}}
                                        {{--<a href="#" class="item_pic_info"--}}
                                        {{--onclick="javascript:deletePic({$i - 1});">删除</a>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}

                                        {{--</volist>--}}

                                    </div>
                                </div>
                            </div>

                        </div><!--相册 结束-->

                    </div><!--Tab panes over-->


                </div><!--tab-home over-->
            </div>
        </div>
    </section>

@endsection

@section('script')
    <link href="{{ elixir('js/admin/um/themes/default/css/umeditor.css')}}" type="text/css" rel="stylesheet">
    <script src="{{ elixir('js/admin/um/umeditor.config.js')}}"></script>
    <script src="{{ elixir('js/admin/um/umeditor.min.js')}}"></script>
    <script src="{{ elixir('js/admin/um/lang/zh-cn/zh-cn.js')}}"></script>
    <script src="{{ elixir('js/admin/goods/base.js')}}"></script>
    <script src="{{ elixir('js/admin/goods/upload_img.js')}}"></script>
    <script src="{{ elixir('js/admin/goods/jquery.ui.widget.js')}}"></script>
    <script src="{{ elixir('js/admin/goods/jquery.fileupload.js')}}"></script>
    <script src="{{ elixir('js/admin/goods/upload_base.js')}}"></script>
    <script src="{{ elixir('js/admin/goods/goods_msg.js')}}"></script>


    <script type="text/javascript">
        var skuCombo = [];
        var img_url = "/images/admin";
        var descriptionUm = UM.getEditor('descriptionText', {
            initialFrameWidth: '90%'
        });
        var contentUm = UM.getEditor('contentText', {
            initialFrameWidth: '90%'
        });
        $("#uploadImg").on("click", function () {
            $('#fileupload').trigger('click');
            upload_img_1('/admin/upload', 'fileupload', onUpload);
            /*第一个参数：上传图片的路径,第二个参数：file_input标签id,第三个参数：回调函数*/
        });
        /*上传主图之后回调*/
        function onUpload(rsp) {
            if (rsp.error_code == 0) {
                $("#pic").attr("src", rsp.data.url);
                $("#banner").val(rsp.data.id);
//                $("#thumbImg").val(rsp.data.url);
            } else {
                swal("上传失败;" + rsp.error_msg, "", "error");
            }
        }
        /* 上传轮播图 */
        $("#uploadSilderImg").on("click", function () {
            $('#fileupload').trigger('click');
            upload_img_1('/admin/upload', 'fileupload', onUploadSilder);
            /*第一个参数：上传图片的路径,第二个参数：file_input标签id,第三个参数：回调函数*/
        });

        /*上传轮播图之后回调*/
        function onUploadSilder(rsp) {
            if (rsp.error_code == 0) {
                uploadPicSucceed(rsp.data.id, rsp.data.url, rsp.data.url, "showPicDiv", 290, 290);
            } else {
                swal("上传失败;" + rsp.error_msg, "", "error");
            }
        }


        function checkGoodsValue() {
            var rt = true;

            var name = $.trim($("#name").val());
            var banner = $.trim($("#banner").val()); // 主图
            var isSale = $(":radio[name='isSale']:checked").val();
            var sku_top_id = $("#sku_def").val();
            var silder = [];// 轮播图
            picJson.path.forEach(function (value, index, array) {
                silder.push(index);
            });

            if (name == '' || name == undefined) {
                rt = false;
                $('#name').focus();
                swal('名称不能为空', '', 'warning');
            } else if (isSale == undefined) {
                rt = false;
                $('#isSale').focus();
                swal('请选择是否上架', '', 'warning');
            } else if (banner == '' || banner == undefined) {
                rt = false;
                $('#banner').focus();
                swal('请上传商品主图', '', 'warning');
            } else if (silder.join(',') == '') {
                rt = false;
                swal('请上传轮播图', '', 'warning');
            } else if (sku_top_id <= 0) {
                rt = false;
                swal('请选择sku商品类型', '', 'warning');
            }
            console.log(silder);
            console.log(silder.join(','));

            return rt;

        }

        $("#save_msg").on("click", function () {
            /* console.log(picJson); */

            // 校验数据
            if (!checkGoodsValue()) {
                return false;
            }
            var ajaxData = {};

            ajaxData.name = $.trim($("#name").val());
            ajaxData.desc = $.trim($("#desc").val());
            ajaxData.description = descriptionUm.getContent(); // 详情
            ajaxData.content = contentUm.getContent(); // 详情
            ajaxData.banner = $.trim($("#banner").val()); // 主图
//            ajaxData.thumbImg = $.trim($("#thumbImg").val()); // 主图缩略图
//            ajaxData.brandID = $("#brandID").val();
//            ajaxData.defaultPrice = $("#defaultPrice").val();
//            ajaxData.salePrice = $("#salePrice").val();
            ajaxData.is_sale = $(":radio[name='isSale']:checked").val();

            var silder = [];// 轮播图
            picJson.path.forEach(function (value, index, array) {
                silder.push(index);
            });
            ajaxData.silder = silder.join(',');

            ajaxData.details = []; // sku组合列表
            $('.skuBanner').each(function (index) {
                self = $(this);
                ajaxData.details[index] = {};

                ajaxData.details[index].original = $.trim(self.find('.defaultPrice_sku').val());
                ajaxData.details[index].price = $.trim(self.find('.salePrice_sku').val());
                ajaxData.details[index].stock = $.trim(self.find('.restNum_sku').val());
                ajaxData.details[index].sales = $.trim(self.find('.num_sku').val());
                ajaxData.details[index].image_id = self.find('img').attr('data-image-id');
                ajaxData.details[index].sku_id_str = self.attr('data-defidstr');
                ajaxData.details[index].is_sale = self.find('.isSale').is(':checked') ? '1' : '0';
            });
            ajaxData.defIDStr = [];

            $('input.top_checkbox:checked').each(function (index) {
                ajaxData.defIDStr.push($(this).val());
            });
            ajaxData.defIDStr = ajaxData.defIDStr.join(',');

            ajaxData.sku_top_id = $("#sku_def").val();
            if ($("#goodsID").val() > 0) {
                ajaxData.goodsID = $("#goodsID").val();
            }

//                console.log(ajaxData);

            ajax_go_1(ajaxData, "/admin/goods", onSave);
        });
        function onSave(rsp) {

            if (rsp.error_code == 0) {

//                if (rsp.type == 'add') {
//                    $("#goodsID").val(rsp.goodsID);
//                }

                swal('保存成功', '', 'success');
                location.href = '/admin/goods/';
            } else {
                swal('保存失败;' + rsp.error_msg, '', 'error');
            }
        }


    </script>
@endsection