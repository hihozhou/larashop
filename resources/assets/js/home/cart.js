$(document).ready(function () {


    var jiasudu = (function () {
        var pubs = {};
        pubs.init = function () {
            pubs.eventBind();
        };
        pubs.eventBind = function () {

            /*增加&减少*/
            $('.add_count').on('click', function () {
                if ($(this).hasClass('can')) {
                    var self = $(this);
                    self.removeClass('can');
                    var num = parseInt($(this).closest('.cart_list').find('.counted').html());
                    var data = {};
                    data.num = 1;
                    data.goods_detail_id = self.closest('.cart_list').attr('data-goods-detail-id');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: cart_goods_add,
                        type: "put",
                        data: data,
                        success: function (data) {
                            self.addClass('can');
                            if (data.error_code == 0) {
                                self.closest('.cart_list ').find('.counted').html(num + 1);
                                pubs.refreshBill();
                            } else {
                                alert(data.error_msg);
                            }
                        },
                        error: function () {
                            self.addClass('can');
                        }
                    });
                }

            });
            $('.minus_count').on('click', function () {
                var self = $(this);
                var num = parseInt($(this).closest('.cart_list').find('.counted').html());
                if (self.hasClass('can')) {
                    if (num == 1) {
                        alert('数量不能少于1！');
                    }
                    else {
                        self.removeClass('can');
                        var data = {};
                        data.num = 1;
                        data.goods_detail_id = self.closest('.cart_list').attr('data-goods-detail-id');
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: cart_goods_subtract,
                            type: "PUT",
                            data: data,
                            success: function (data) {
                                self.addClass('can');
                                if (data.error_code == 0) {
                                    self.closest('.cart_list').find('.counted').html(num - 1);
                                    pubs.refreshBill();
                                }
                                else {
                                    alert(data.error_msg);
                                }

                            },
                            error: function () {
                                self.addClass('can');
                            }
                        });
                    }
                }

            });

            /*删除*/
            $('.cart_list_delete').on('click', function () {
                var self = $(this);
                if (confirm('确定删除？')) {
                    var ajaxData = {};
                    var id = $(this).closest('.cart_list').attr('data-id');
                    pubs.ajax_go(ajaxData, cart_goods_delete + id, function () {
                        self.closest('.cart_list').remove();
                        pubs.refreshBill();
                        if ($('.cart_list').length == 0) {
                            $('.order_wrapper').fadeIn();
                            $('.cart_foot').fadeOut();
                        }
                    }, true);
                }
            });

            pubs.refreshBill = function () {
                var totalPrice = 0;
                var totalNum = 0;
                $('.cart_list').each(function (index, element) {
                    var num = parseInt($(this).closest('.cart_list').find('.counted').html());
                    var price = $(this).closest('.cart_list').attr('data-goods-detail-price');
                    totalPrice = totalPrice + num * price;
                    totalNum = totalNum + num;
                });
                var cart_foot_text = $('.cart_foot_text');
                cart_foot_text.find('.total_count').html(totalNum);
                cart_foot_text.find('.total_price').html(totalPrice);
            };

            pubs.ajax_go = function (data, url, func, goOn) {
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
                    type: "delete",
                    data: data,
                    success: function (data) {
                        if (data.error_code == 0) {
                            if (func != undefined)
                                func(data);

                            if (goOn == undefined) {

                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            }
                            setTimeout(function () {
                                overlay.hide();
                            }, 2000);
                            overlay.update({
                                text: '提交成功',
                                icon: loading_url + "check.png"
                            });

                        } else {

                            overlay.hide();
                            alert(data.error_msg);

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

            /*立即结算*/
            //$('#buy_now').on('click', function () {
            //    var opts = {
            //        lines: 13, // The number of lines to draw
            //        length: 12, // The length of each line
            //        width: 5, // The line thickness
            //        radius: 17, // The radius of the inner circle
            //        corners: 1, // Corner roundness (0..1)
            //        rotate: 0, // The rotation offset
            //        color: '#FFF', // #rgb or #rrggbb
            //        speed: 1, // Rounds per second
            //        trail: 60, // Afterglow percentage
            //        shadow: false, // Whether to render a shadow
            //        hwaccel: false, // Whether to use hardware acceleration
            //        className: 'spinner', // The CSS class to assign to the spinner
            //        zIndex: 2e9, // The z-index (defaults to 2000000000)
            //        top: 'auto', // Top position relative to parent in px
            //        left: 'auto' // Left position relative to parent in px
            //    };
            //    var target = document.createElement("div");
            //    document.body.appendChild(target);
            //    var spinner = new Spinner(opts).spin(target);
            //    window.overlay = iosOverlay({
            //        text: "正在请求",
            //        spinner: spinner
            //    });
            //    $.ajax({
            //        headers: {
            //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //        },
            //        url: buy_url,
            //        type: "post",
            //        data: {},
            //        success: function (data) {
            //            if (data.error_code == 0) {
            //                setTimeout(function () {
            //                    overlay.hide();
            //                }, 2000);
            //                overlay.update({
            //                    text: '提交成功',
            //                    icon: loading_url + "check.png"
            //                });
            //                //跳转到订单页面
            //            } else {
            //
            //                overlay.hide();
            //                alert(data.error_msg);
            //
            //            }
            //
            //        },
            //        error: function () {
            //            overlay.update({
            //                text: '提交失败',
            //                icon: loading_url + "cross.png"
            //            });
            //            setTimeout(function () {
            //                overlay.hide();
            //            }, 2000);
            //        }
            //    });
            //});


        };
        return pubs;
    })();
    jiasudu.init();
});
