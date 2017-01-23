$(document).ready(function () {
    var mySwiper = new Swiper('.swiper-container', {
        loop: true,
        pagination: '.swiper-pagination',
        paginationClickable: true,
        autoplay: 5000
    });

    var goodsShow = (function () {
        var pubs = {};
        pubs.activeid = [];
        pubs.groupLen = '';
        pubs.emptyGroup = [];
        pubs.chooseGoodsDetail = null;
        pubs.chooseKey = null;
        pubs.chooseGoodsDetailId = null;
        pubs.skuID = null;
        pubs.init = function () {
            /*遍历所有组合，找到没有库存的组合*/
            for (var i = 0, len = goodsDetails.length; i < len; i++) {
                if (goodsDetails[i].restNum == 0) {
                    pubs.emptyGroup.push(goodsDetails[i]);
                }
            }
            pubs.refresh_group(skus);
            pubs.eventBind();
        };
        pubs.eventBind = function () {
            var sku_block = $('.sku_block');
            sku_block.unbind('click');
            /**
             * sku单元点击事件
             */
            sku_block.on('click', function () {
                $(this).siblings().removeClass('active').end().addClass('active');

                pubs.activeid = [];
                $('.sku_block.active').each(function () {
                    pubs.activeid.push($(this).attr('data-id'));
                });
                //console.log(pubs.activeid);

                pubs.refresh_rest_num();
            });

            /*增加&减少*/
            $('.add_count').unbind('click');
            $('.add_count').on('click', function () {
                var stock = $.trim($('.restNum').html());
                if (stock == 0) {
                    alert('库存为0！');
                } else {
                    var num = parseInt($('.counted').html());
                    if (num + 1 <= stock) {
                        $('.counted').html(num + 1);
                    }
                }


            });
            $('.minus_count').unbind('click');
            $('.minus_count').on('click', function () {
                if ($.trim($('.restNum').html()) == 0) {
                    alert('库存为0！');
                }
                else {
                    var num = parseInt($('.counted').html());
                    if (num == 1) {
                        alert('数量不能少于1！');
                    }
                    else {
                        $('.counted').html(num - 1);
                    }
                }

            });

            /**/
            $('.goods_qie').unbind('click');
            $('.goods_qie').on('click', function () {
                $(this).addClass('active').siblings().removeClass('active');
                var ddid = $(this).attr('data-id');
                $('#' + ddid).siblings().hide();
                $('#' + ddid).fadeIn();
            });

            /*加入购物车*/
            $('#go_cart').on('click', function () {
                if ($('.sku_block.active').length != pubs.groupLen) {
                    alert('请选择属性！')
                }
                else if ($.trim($('.counted').html()) == 0) {
                    alert('数量不能为0');
                }
                else if ($.trim($('.restNum').html()) == 0) {
                    alert('库存为0！');
                } else if (pubs.chooseGoodsDetailId == null) {
                    alert('请选择有效的商品');
                }
                else {
                    var ajaxData = {};
                    ajaxData.goods_detail_id = pubs.chooseGoodsDetailId;
                    ajaxData.num = $.trim($('.counted').html());
                    pubs.ajax_go(ajaxData, add_cart_url, function () {
                    }, true, '加入购物车成功');
                }
            });

            /*立即购买*/
            $('#buy_now').on('click', function () {
                if ($('.sku_block.active').length != pubs.groupLen) {
                    alert('请选择属性！')
                }
                else if ($.trim($('.counted').html()) == 0) {
                    alert('数量不能为0');
                }
                else if ($.trim($('.restNum').html()) == 0) {
                    alert('库存为0！');
                } else if (pubs.chooseGoodsDetailId == null) {
                    alert('请选择有效的商品');
                } else {
                    var ajaxData = {};
                    ajaxData.goods_detail_id = pubs.chooseGoodsDetailId;
                    ajaxData.num = $.trim($('.restNum').html());
                    pubs.ajax_go(ajaxData, add_cart_url, function () {
                        window.location.href = cart_url;
                    }, true);
                }
            });


        };
        pubs.refresh_group = function (data) {
            console.log(data);
            var sku_wraper = $('.sku_wraper');
            /*清空*/
            sku_wraper.empty();

            /*遍历*/
            var group_html = "";

            for (var i = 0, len = data.length; i < len; i++) {
                group_html += '<p class="sku_title" data-id="' +
                    data[i].id +
                    '">' +
                    data[i].name +
                    '</p>';
                group_html += '<div class="sku_list_inner clearfix">';

                for (var j = 0, len2 = data[i].childs.length; j < len2; j++) {
                    group_html += '<span class="sku_block pull-left';

                    for (var h = 0, len3 = pubs.activeid.length; h < len3; h++) {
                        if (pubs.activeid == data[i].childs[j].id) {
                            group_html += ' active ';
                            break;
                        }
                    }
                    group_html += '" data-id="' +
                        data[i].childs[j].id +
                        '" data-pid="' +
                        data[i].childs[j].parent +
                        '">' +
                        data[i].childs[j].name +
                        '</span>';
                }
                group_html += '</div>';
            }

            sku_wraper.append(group_html);

            pubs.groupLen = $('.sku_list_inner').length;

        };

        pubs.refresh_rest_num = function () {
            var str_active_id = pubs.activeid.join(',');

            var chooseSuccess = false;
            var key = 0;
            goodsDetails.forEach(function (goodsDetail, index) {
                var sku_ids = [];
                goodsDetail['skus'].forEach(function (sku) {
                    sku_ids.push(sku['sku_id']);
                });
                if (sku_ids == str_active_id) {
                    key = index;
                    chooseSuccess = true;
                    //console.log(goodsDetail);
                }
            });
            if (chooseSuccess == true) {
                //console.log(goodsDetails[key]);
                pubs.chooseGoodsDetail = goodsDetails[key];
                pubs.chooseKey = key;
                pubs.chooseGoodsDetailId = goodsDetails[key].id;
                $('.restNum').html(goodsDetails[key].stock);
                $('.goods_price').html(goodsDetails[key].price);
                $('.market_price').html('市场价：￥' + goodsDetails[key].original);

            } else {
                pubs.chooseGoodsDetail = null;
                pubs.chooseKey = null;
                pubs.chooseGoodsDetailId = null;
                $('.restNum').html(0);
                $('.goods_price').html(0.00);
                $('.market_price').html('市场价：￥' + 0);
                $("#buy_now").attr('disabled', true);
            }
            //for (var i = 0, len = goodsDetails.length; i < len; i++) {
            //    if (goodsDetails[i].defStr == str_active_id) {
            //        $('.restNum').html(goodsDetails[i].restNum);
            //        $('.goods_price').html(goodsDetails[i].salePrice);
            //        $('.market_price').html('市场价：￥' + goodsDetails[i].defaultPrice);
            //        pubs.skuID = goodsDetails[i].skuID;
            //
            //        break;
            //    }
            //}
        };

        pubs.ajax_go = function (ajaxData, url, func, goOn, successText) {
            var opts = {
                lines: 13, // The number of lines to draw
                length: 12, // The length of each line
                width: 5, // The line thickness
                radius: 17, // The radius of the inner circle
                corners: 1, // Corner roundness (0..1)
                rotate: 0, // The rotation offset
                color: '#FFF', // #rgb or #rrggbb
                speed: 1, // Rounds per second
                trail: 60, // Afterglow percentage
                shadow: false, // Whether to render a shadow
                hwaccel: false, // Whether to use hardware acceleration
                className: 'spinner', // The CSS class to assign to the spinner
                zIndex: 2e9, // The z-index (defaults to 2000000000)
                top: 'auto', // Top position relative to parent in px
                left: 'auto' // Left position relative to parent in px
            };
            var target = document.createElement("div");
            document.body.appendChild(target);
            var spinner = new Spinner(opts).spin(target);
            window.overlay = iosOverlay({
                text: "正在请求",
                spinner: spinner
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "post",
                data: ajaxData,
                success: function (data) {
                    console.log(data);
                    if (data.error_code === 0) {
                        console.log(func);
                        if (func != undefined)
                            func(data);
                        console.log(goOn);
                        if (goOn == undefined) {
                            setTimeout(function () {
                                window.location.reload();
                            }, 2000);
                        }

                        setTimeout(function () {
                            overlay.hide();
                        }, 2000);

                        successText = successText != undefined ? successText : '提交成功';
                        overlay.update({
                            text: successText,
                            icon: loading_url + "check.png"
                        });


                    } else if (data.error_code == 401) {
                        //显示登录
                        overlay.hide();
                        //立即绑定
                        $('.loginForm').css('display', 'block');
                        //alert('要登录啦阿拉');
                    } else {
                        overlay.hide();
                        alert(data.info);

                    }

                },
                error: function () {
                    overlay.update({
                        text: '提交失败',
                        icon: loading_url + "cross.png"
                    });
                    setTimeout(function () {
                        overlay.hide();
                    }, 2000);
                }
            });
        };
        return pubs;
    })();
    goodsShow.init();
});
