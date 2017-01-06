<template>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!--在这里写-->
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs clearfix" role="tablist">
                        <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab"
                                                                  data-toggle="tab">基本信息</a></li>
                        <li role="presentation"><a href="#profile1" aria-controls="profile1" role="tab"
                                                   data-toggle="tab">参数描述</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">详细描述</a>
                        </li>
                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab"
                                                   data-toggle="tab">SKU</a></li>
                        <li role="presentation"><a href="#settings" aria-controls="settings" role="tab"
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
                                        <input id="goodsName" value="" type="text" class="form-control"/>
                                        <input id="goodsID" value="{$arr.goodsID}" type="hidden"/>
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

                                <div class="col-md-12 margin10 account">
                                    <div class="col-md-12 text_right form_bar ">
                                        <div class="col-md-2 text_right form_bar">
                                            是否前台显示：
                                        </div>
                                        <form class="pull-left">
                                            <div class="btn-group clearfix" data-toggle="buttons">
                                                <label class="btn btn-warning ">
                                                    <input name="isShow" type="radio" id="show_1" autocomplete="off"
                                                           value="1" checked> 显示
                                                </label>
                                                <label class="btn btn-warning">
                                                    <input name="isShow" type="radio" id="show_0" autocomplete="off"
                                                           value="0" checked> 不显
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-6  form_bar">

                                    </div>
                                </div>

                                <div class="col-md-12 margin10">
                                    <div class="col-md-2 text_right form_bar">
                                        总库存：
                                    </div>
                                    <div class="col-md-4">
                                        <input id="goodsNum" value="" type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-1 text_warning text_left form_bar">
                                        *
                                    </div>
                                </div>

                                <div class="col-md-12 margin10">
                                    <div class="col-md-2 text_right form_bar">
                                        上架销售：
                                    </div>
                                    <div class="col-md-4">
                                        <!--<div class="col-md-12 margin10">-->
                                        <div class="btn-group clearfix" data-toggle="buttons">
                                            <label class="btn btn-warning active">
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
                                        <!--</div>-->
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
                        <div role="tabpanel" class="tab-pane" id="profile1">
                            <textarea id="content1"></textarea>
                        </div>
                        <!--参数描述 结束-->

                        <!--详细信息 开始-->
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <textarea id="content"></textarea>
                        </div><!--详细信息 结束-->


                    </div>


                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { stack_bottomright, show_stack_success, show_stack_error } from '../Pnotice.js'
    export default {
        mounted(){
            this.aa();
        },
        data () {
            return {}
        },
        methods: {
            aa(){
                alert(123);
                console.log('123123');
                console.log(UM);
            }
        }
    }
</script>
<!--Add "scoped" attribute to limit CSS to this component only-->
<script type="text/javascript">
//    $(function () {
//        window.um = UM.getEditor('content', {
            /* 传入配置参数,可配参数列表看umeditor.config.js */
//        });
//    });
    //    var UM = parent.UM;
    //    var um = UM.getEditor('content', {
    //        initialFrameWidth: '90%'
    //    });  // 编辑器初始化
</script>


<style scoped>
    h1 {
        color: #42b983;
    }
</style>