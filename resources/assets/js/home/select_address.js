/**
 * Created by xiaowuge on 2015/4/12.
 */
$(function () {
    $('.check_radio').on('click', function () {
        $('.check_radio').removeClass('active');
        $(this).addClass('active');

    });

    $('#btn_confirm').unbind('click');
    /*确定*/
    $('#btn_confirm').on('click', function () {
        var address_id = $('.check_radio.active').closest('a').attr('data-id');
        if (address_id == null || address_id == undefined) {
            alert('请选择收货地址');
        } else {
            var ajaxData = {address_id: address_id};
            ajax_go(ajaxData, url, null, true);
        }
    });

    var ajax_go = function (data, url, func, goOn) {
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
            data: data,
            success: function (data) {
                //console.log(data);return;
                if (data.error_code === 0) {
                    //console.log(func instanceof Function);
                    console.log(data);
                    //return;
                    if (typeof func == 'function' || func instanceof Function) {
                        func(data);
                    }
                    if (goOn == true) {
                        setTimeout(function () {
                            overlay.hide();
                        }, 2000);
                        overlay.update({
                            text: '提交成功',
                            icon: loading_url + "check.png"
                        });
                        if (data.data.url == undefined) {
                            throw new Error("don't has url by respone");
                        }
                        window.location.href = data.data.url;
                    }
                } else {
                    overlay.update({
                        text: data.error_msg,
                        icon: loading_url + "cross.png"
                    });
                    setTimeout(function () {
                        overlay.hide();
                    }, 1000);
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

    $('.edit,.add').on('click', function () {
        var self = $(this), ajaxData = {}, url = '';
        var type = 'post';
        $('.address_pop').fadeIn();
        if ($(this).hasClass('edit')) {
            type = 'put';
            url = 'address/' + self.closest('.address_list').attr('data-id');
            var name = $.trim(self.closest('.address_list').find('.detail_name').html());
            var phone = $.trim(self.closest('.address_list').find('.detail_phone').html());
            var address = $.trim(self.closest('.address_list').find('.detail_add').html());

            $('.pop_name').val(name);
            $('.pop_phone').val(phone);

            $('.pop_address').val(address);
            $('#s_province').val(self.closest('.address_list').find('.province_add').html()).trigger('change');
            $('#s_city').val(self.closest('.address_list').find('.city_add').html()).trigger('change');
            $('#s_county').val(self.closest('.address_list').find('.district_add').html()).trigger('change');
        } else {

            url = add_url;
            $('.pop_name,.pop_phone,.pop_pcd,.pop_address').each(function () {
                $(this).val('');
            });

            $('#s_province').val('省份');
            $('#s_city').val('地级市');
            $('#s_county').val('市、县级市');


        }
        $('.save').unbind('click');
        $('.save').on('click', function () {


            if ($.trim($('.pop_name').val()) === '') {
                alert('请填写收货人姓名!');
                return false;
            }
            else if ($.trim($('.pop_phone').val()) === '') {
                alert('请填写手机号码!');
                return false;
            }
            else if ($('#s_province').val() == '省份') {
                alert('请选择省份!');
                return false;
            }
            else if ($('#s_city').val() == '地级市') {
                alert('请选择地级市!');
                return false;
            }
            else if ($('#s_county').val() == '市、县级市') {
                alert('请选择市、县级市!');
                return false;
            }

            else if ($.trim($('.pop_address').val()) === '') {
                alert('请填写详细地址!');
                return false;
            }

            else if (isNaN($.trim($('.pop_phone').val())) || $.trim($('.pop_phone').val()).length != 11) {
                alert('请填写正确的手机格式!');
                return false;
            }

            ajaxData.id = self.attr('data-id');
            ajaxData.consignee = $.trim($('.pop_name').val());
            ajaxData.phone = $.trim($('.pop_phone').val());
            ajaxData.address = $.trim($('.pop_address').val());

            ajaxData.province = $.trim($('#s_province').val());
            ajaxData.city = $.trim($('#s_city').val());
            ajaxData.district = $.trim($('#s_county').val());

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
                text: "正在提交",
                spinner: spinner
            });


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: type,
                data: ajaxData,
                success: function (data) {

                    if (data.error_code === 0) {
                        overlay.update({
                            text: '提交成功！',
                            icon: loading_url + "check.png"
                        });
                        setTimeout(function () {
                            overlay.hide();
                            window.location.reload();
                        }, 2000);
                    }
                    else {
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
        });


        $('.cancel').on('click', function () {
            $('.address_pop').fadeOut();
        });


    });
});