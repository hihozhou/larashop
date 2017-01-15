$(function () {
    var sku = (function () {
        var pubs = {};

        /*select 选中的值*/
        pubs.pid = null;

        /*当前上传图片对应的skuImg*/
        pubs.uploadDom = null;

        pubs.goodsID = $('#goodsID').val();
        /*页面绑定好的*/
        pubs.skuCombo = skuCombo;
        pubs.init = function () {
            pubs.event_bind();
        };

        /*当前图片上传对应的input*/
        pubs.event_bind = function () {

            /*select change*/
            $('#sku_def').unbind('change');
            $('#sku_def').on('change', function () {
                pubs.pid = $(this).find('option:selected').val();
                var ajaxData = {};
                //ajaxData.parent = pubs.parent;
                //ajaxData.goodsID = pubs.goodsID;
                var sku_select_url = '/api/admin/sku/' + pubs.pid + '/childs';
                ajax_go_1(ajaxData, sku_select_url, pubs.refresh_checkbox, 'GET');
            });

            /**
             * 选好了点击事件
             */
            $('#check_confirm').on('click', function () {
                /*将check数据封装为类似后台的数据*/
                var check_box_data = {};

                var native_data = [], arrCheckDom = [];
                $('.check_box_line').each(function (index) {
                    if ($(this).find('input[type="checkbox"]:checked').length > 0)
                        arrCheckDom.push($(this));
                });

                for (var i = 0, len = arrCheckDom.length; i < len; i++) {
                    native_data[i] = [];
                    arrCheckDom[i].find('input[type="checkbox"]:checked').each(function (index2) {
                        native_data[i][index2] = {};
                        native_data[i][index2]['id'] = $(this).val();
                        native_data[i][index2]['name'] = $(this).closest('label').attr('title');

                    });
                }

                xw_loader.start();
                var data = pubs.printCombination(native_data, true);
                xw_loader.end();

                /*初步组装为groupdata*/
                var group_data = [];
                for (var i = 0, len = data.length; i < len; i++) {
                    group_data[i] = {};
                    group_data[i].defIDArr = [];

                    var defIDStr = '';
                    group_data[i].defIDStr = '';
                    var nativestr = [];
                    for (var j = 0, len2 = data[i].length; j < len2; j++) {
                        group_data[i].defIDArr.push(data[i][j]);
                        nativestr.push(data[i][j].id);
                    }

                    group_data[i].defIDStr = nativestr.join(',');

                    /*比对有input数据的原groupdata,如果defIDStr相同，则插入此旧数据到group_data*/
                    for (var k = 0, len3 = pubs.skuCombo.length; k < len3; k++) {
                        if (pubs.skuCombo[k].defIDStr == group_data[i].defIDStr) {
                            group_data[i] = pubs.skuCombo[k];
                            break;
                        }
                    }
                }

                pubs.refresh_group(group_data);
            });


            /*触发图片上传*/
            pubs.filesUpload();


            /*点击file修改dom*/
            $('.upload_list').on('click', function () {

                pubs.uploadDom = $(this).closest('.skuImg');
            });

        };

        /*初始化各种属性，checkbox*/
        pubs.refresh_checkbox = function (data) {
            var check_data = data.data.skus;//子sku tree
            //console.log(data);
            pubs.skuCombo = data.data.skuCombList;//已有的sku商品组合
            var sku_checkbox_wrapper = $('#sku_checkbox_wrapper');
            sku_checkbox_wrapper.empty();//清空2级sku属性选择
            for (var i in check_data) {
                var checkbox_html = '<div class="pl50 clearfix">';

                checkbox_html += '<div class=" form_bar col-xs-1 text_right">' +
                    check_data[i].name +
                    '：&nbsp;&nbsp;</div>';
                checkbox_html += '<div class="col-xs-11 check_box_line">';

                for (var j = 0, len2 = check_data[i].childs.length; j < len2; j++) {

                    checkbox_html += '<div class=" col-xs-2 form_bar">' +
                        '<label title="' +
                        check_data[i].childs[j].name +
                        '"><input type="checkbox" class="top_checkbox" value="' +
                        check_data[i].childs[j].id +
                        '" ';
                    checkbox_html += check_data[i].childs[j].checked === 'checked' ? 'checked="checked"' : '';


                    checkbox_html += '>' +
                        check_data[i].childs[j].name +
                        '</label>' +
                        '</div>';

                }

                checkbox_html += '</div>';
                checkbox_html += '</div>';

                sku_checkbox_wrapper.append(checkbox_html);
            }

            pubs.refresh_group(pubs.skuCombo);

        };

        /**
         * 刷新sku组合
         * @param data
         */
        pubs.refresh_group = function (data) {

            $('#sku_group').empty();

            for (var i = 0, len = data.length; i < len; i++) {
                var sku_group_html = '';
                /*图片上传部分*/
                sku_group_html += '<div class="border clearfix padding10 skuBanner" data-defIDStr="' +
                    data[i].defIDStr +
                    '">';
                sku_group_html += '<div class="col-xs-2"><p class="form_bar text_center">SKU组合-' +
                    (i + 1) +
                    '</p>' +
                    '<div class="skuImg">' +
                    '<img src="' +
                    pubs.filtUndefined(data[i].thumbImg) +
                    '" class="width100" alt="" data-src="' +
                    pubs.filtUndefined(data[i].img) +
                    '">' +
                    '<input type="file" class="input_file upload_list" name="file" value="" data-url="" multiple="" id="' +
                    'upload' + i +
                    '">' +
                    '</div>' +
                    '</div>';

                /*输入框部分*/
                sku_group_html += '<div class="col-xs-4">' +
                    '<p class="col-xs-3 pr5">' +
                    '<span class="form_bar mb10 col-xs-12 small_text">原价</span>' +
                    '<input type="text"   value="' +
                    pubs.filtUndefined(data[i].defaultPrice) +
                    '" class="form-control defaultPrice_sku">' +
                    '</p>' +
                    '<p class="col-xs-3 pr5">' +
                    '<span class="form_bar mb10 col-xs-12 small_text">销售价</span>' +
                    '<input type="text"  value="' +
                    pubs.filtUndefined(data[i].salePrice) +
                    '" class="form-control salePrice_sku">' +
                    '</p>' +
                    '<p class="col-xs-3 pr5">' +
                    '' +
                    '<span class="form_bar mb10 col-xs-12 small_text">库存</span>' +
                    '<input type="text"   value="' +
                    pubs.filtUndefined(data[i].restNum) +
                    '" class="form-control restNum_sku">' +
                    '</p><p class="col-xs-3 pr5">' +
                    '<span class="form_bar mb10 col-xs-12 small_text">销售量</span>' +
                    '<input type="text"   value="' +
                    pubs.filtUndefined(data[i].num) +
                    '" class="form-control num_sku">' +
                    '</p>' +
                    '</div>';

                /*属性组合*/
                sku_group_html += '<div class="col-xs-4">' + '<p class="form_bar"> SKU属性组合</p>';
                for (var j = 0, len2 = data[i].defIDArr.length; j < len2; j++) {
                    sku_group_html += '<div data-id="' +
                        data[i].defIDArr[j].defID +
                        '" class="col-xs-4 ">' +
                        '<span class="skuBt pull-left" title="' +
                        data[i].defIDArr[j].name +
                        '">' +
                        data[i].defIDArr[j].name +
                        '</span>' +
                        '</div>';
                }

                sku_group_html += '</div>';
                /*checkbox*/
                sku_group_html += '<div class="col-xs-2">' +
                    '<p class="col-xs-4 text-center">' +
                    '<span class="form_bar mb10 col-xs-12 small_text">上架</span>' +
                    '<input type="checkbox" class="isSale"';
                sku_group_html += data[i].isSale == '1' ? 'checked="checked"' : '';
                sku_group_html += '>' +
                    '</p>' +
                //    '<p class="col-xs-4 text-center">' +
                //    '<span class="form_bar mb10 col-xs-12 small_text">默认</span>' +
                //    '<input type="checkbox" class="isDefault" ';
                //sku_group_html += data[i].isDefault == '1' ? 'checked="checked"' : '';
                //sku_group_html += '>' +
                //    '</p>' +
                    '</div>';


                sku_group_html += '</span></div>';

                sku_group_html += '</div>';
                sku_group_html += '</div>';

                $('#sku_group').append(sku_group_html);
            }

            pubs.event_bind();

        };
        pubs.printCombination = function (doubleArrays, isFirstTime) {
            var len = doubleArrays.length;
            if (len >= 2) {
                var len1 = doubleArrays[0].length;
                var len2 = doubleArrays[1].length;
                var newlen = len1 * len2;
                var temp = new Array(newlen);
                var index = 0;
                for (var i = 0; i < len1; i++) {
                    for (var j = 0; j < len2; j++) {

                        if (!!isFirstTime) {
                            temp[index] = [];
                            temp[index].push(doubleArrays[0][i]);
                            temp[index].push(doubleArrays[1][j]);
                        }
                        else {

                            temp[index] = [];
                            for (var k = 0, len3 = doubleArrays[0][i].length; k < len3; k++) {
                                temp[index].push(doubleArrays[0][i][k]);
                            }
                            temp[index].push(doubleArrays[1][j]);
                        }


                        index++;
                    }
                }

                var arr = [];
                for (var j = 0, len2 = temp.length; j < len2; j++) {
                    arr.push(temp[j]);

                }
                temp = arr;
                var newArray = new Array(len - 1);
                for (var i = 2; i < len; i++) {
                    newArray[i - 1] = doubleArrays[i];
                }
                newArray[0] = temp;
                return pubs.printCombination(newArray);
            }
            else {
                return doubleArrays[0];
            }
        };
        pubs.filtUndefined = function (data) {
            if (data != undefined) {
                return data;
            }
            else {
                return '';
            }
        };
        pubs.filesUpload = function () {
            var goodDetailImgUrl = '/admin/upload';
            $('.upload_list').each(function (index, item) {
                upload_img_1(goodDetailImgUrl, $(this).attr('id'), function (data) {
                    console.log(data);
                    var self = $('#' + $(this).attr('id'));
                    pubs.uploadDom.closest('.skuImg').find('img').attr('src', data.data.url);
                    pubs.uploadDom.closest('.skuImg').find('img').attr('data-image-id', data.data.id);
                });
            });


        }
        return pubs;

    })();

    sku.init();


});




