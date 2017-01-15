$(function () {
//  $(window).load(function () {
//      $("#left_menu").mCustomScrollbar({
//          scrollButtons: {
//              enable: true,
//              theme: "dark"
//          }
//      });
//  });
    //隐藏左边菜单
    $('#toggleLeft').click(function () {
        if ($(this).attr('data-id') == 1) {
            $('.left_menu').css('display', 'none');
            $(this).attr('data-id', 0);
            $(this).html('显示左边');
            $('#right-content').css('padding-left', '0');
        } else {
            $('.left_menu').css('display', 'block');
            $(this).attr('data-id', 1);
            $(this).html('隐藏左边');
            $('#right-content').css('padding-left', '180px');
        }
    });

    /*左边折叠菜单*/
    $('.page_menu_left>li>a').unbind('click');
    $('.page_menu_left>li>a').each(function (index) {
        $(this).attr('data-index', index);
    });

    $('.page_menu_left>li>a').on('click', function () {
        $('.sub_menu').css('display', 'none');
        $('.sub_menu').eq($(this).attr('data-index')).css('display', 'block');
        if ($(this).closest('li').hasClass('open')) {
//          $(this).next().slideUp(200);
            $(this).closest('li').removeClass('open');
            return false;
        }
        else {
            $(this).closest('li').siblings().each(function () {
//              $(this).find('ul.sub_menu').slideUp(200);
                $(this).removeClass('open');
            });
            $(this).next().slideDown(200).closest('li').addClass('open');
            window.location.href = $(this).next().find('li').eq(0).find('a').attr('href');
            return false;
        }
    });


    $('#message_wraper').on('close.bs.alert', function () {
        $(this).fadeOut();
        return false;
    });

    $('#message_w_alert').on('close.bs.alert', function () {
        $(this).fadeOut();
        return false;
    });

});

function ajax_go(data, url, reload) {
    swal('正在提交，请稍后....');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: "POST",
        data: data,
        cache: false,
        success: function (msg) {
            if (msg.result === 1) {
                swal('操作成功', '', 'success');

                if (reload) {
                    window.location.reload();
                }
                $('#myModal').modal("hide");
                return 1;
            }
            else {
                swal('操作失败：' + msg.desc, '', 'error');
                return 0;
            }

        },
        error: function (ex) {
            swal('操作错误', '', 'error');
            return 0;
        }
    });

}
function ajax_go_1(data, url, call_back_func, type = 'POST') {
    xw_loader.start();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        type: type,
        data: data,
        cache: false,
        success: function (msg) {
            xw_loader.end();
            call_back_func(msg);

        },
        error: function (ex) {
            xw_loader.end();
            swal('操作错误', '', 'error');
            return 0;
        }
    });

}

var xw_loader = {
    end: function () {
        $('#xw_loader').remove();
    },
    start: function () {
        if (img_url != undefined){
            $('body').append(' <div id="xw_loader" style=""><img src="' + img_url + '/xw_loader.gif" alt=""/></div>');
        }
    }
};

var myc = (function () {

    //定时器
    function repeat(f, t, c) {
        var count = 0;
        return setTimeout(function () {
            if (f(++count) === false) return;
            else if (c && count >= c) return;
            else setTimeout(arguments.callee, t);
        }, t);
    }

    //弹出框
    function alert(obj, callback) {
        var title = obj.title || '系统提示';
        var msg = obj.msg || '';
        if (obj.buttons) {
            var buttons = obj.buttons;
        } else {
            var buttons = ['确定'];
        }
        if (document.getElementById("alertbackground")) {
            document.getElementById("alertbackground").style.display = 'block';
            document.getElementById("alertContainer").style.display = 'block';
        } else {
            var html = '<div id="alertbackground" style="position: fixed;left: 0;top: 0px;width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);z-index:9999999"></div><div id="alertContainer" style="position: fixed;left: 50%;top: 50%;-webkit-transform: translateX(-50%) translateY(-50%);-moz-transform: translateX(-50%) translateY(-50%);-ms-transform: translateX(-50%) translateY(-50%);-o-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);width: 300px;height: auto;z-index: 9999999;background-color: #fff;text-align: center;border-radius: 7px;"><div id="alertTitle" style="height: 40px;line-height: 40px;color: #45c01a;font-size: 18px;border-bottom: 1px solid #45c01a;"></div><div id="alertMsg"  style="min-height: 50px;padding: 10px;word-break:break-all;word-wrap:break-word;"></div><div id="alertBtnContainer" style="position: relative;height: 40px;line-height: 40px;border-top: 1px solid #e1e1e1;"></div></div>';
            document.body.insertAdjacentHTML('beforeEnd', html);
        }

        document.getElementById("alertTitle").innerHTML = title;
        document.getElementById("alertMsg").innerHTML = msg;


        var btnStyle = '<div style="position: absolute;left: 0;width: 100%;">' + buttons[0];
        document.getElementById("alertBtnContainer").innerHTML = btnStyle;

        var divs = document.getElementById("alertBtnContainer").querySelectorAll('div');
        for (var i = 0; i < divs.length; i++) {
            divs[i].addEventListener('click', function () {
                if (callback && typeof(callback) == 'function') {
                    callback();
                    alertHide();
                } else {
                    alertHide();
                }
            }, false);
        }
        document.getElementById("alertbackground").addEventListener('click', function () {
            event.stopPropagation();
            event.preventDefault();
            alertHide();
        }, false);

        function alertHide() {
            document.getElementById("alertbackground").style.display = 'none';
            document.getElementById("alertContainer").style.display = 'none';
        }
    }

    //弹出带两个或三个按钮的confirm对话框
    function confirm(obj, callback) {
        var title = obj.title || '系统提示';
        var msg = obj.msg || '';
        if (obj.buttons) {
            if (obj.buttons.length == 1) {
                var buttons = [obj.buttons[0], '取消'];
            } else {
                var buttons = obj.buttons;
            }
        } else {
            var buttons = ['确定', '取消'];
        }
        if (document.getElementById("confirmbackground")) {
            document.getElementById("confirmbackground").style.display = 'block';
            document.getElementById("confirmContainer").style.display = 'block';
        } else {
            var html = '<div id="confirmbackground" style="position: fixed;left: 0;top: 0px;width: 100%;height: 100%;background-color: rgba(0,0,0,0.5);z-index:9999999"></div><div id="confirmContainer" style="position: fixed;left: 50%;top: 50%;-webkit-transform: translateX(-50%) translateY(-50%);-moz-transform: translateX(-50%) translateY(-50%);-ms-transform: translateX(-50%) translateY(-50%);-o-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);width: 300px;height: auto;z-index: 9999999;background-color: #fff;text-align: center;border-radius: 7px;"><div id="confirmTitle" style="height: 40px;line-height: 40px;color: #45c01a;font-size: 18px;border-bottom: 1px solid #45c01a;"></div><div id="confirmMsg"  style="min-height: 50px;padding: 10px;word-break:break-all;word-wrap:break-word;"></div><div id="confirmBtnContainer" style="position: relative;height: 40px;line-height: 40px;border-top: 1px solid #e1e1e1;"></div></div>';
            document.body.insertAdjacentHTML('beforeEnd', html);
        }

        document.getElementById("confirmTitle").innerHTML = title;
        document.getElementById("confirmMsg").innerHTML = msg;

        if (buttons.length <= 2) {
            var btnStyle = '<div style="position: absolute;left: 0;width: 50%;border-right: 1px solid #e1e1e1;">' + buttons[0] + '</div><div style="position: absolute;right: 0;width: 50%;">' + buttons[1] + '</div>';
            document.getElementById("confirmBtnContainer").innerHTML = btnStyle;
        } else {
            var btnStyle = '<div style="position: absolute;left: 0;width: 33.3%;border-right: 1px solid #e1e1e1;">' + buttons[0] + '</div><div style="position: absolute;left:33.3%;width: 33.3%;border-right: 1px solid #e1e1e1;">' + buttons[1] + '</div><div style="position: absolute;right: 0;width: 33.3%;">' + buttons[2] + '</div>';
            document.getElementById("confirmBtnContainer").innerHTML = btnStyle;
        }
        var divs = document.getElementById("confirmBtnContainer").querySelectorAll('div');
        for (var i = 0; i < divs.length; i++) {
            divs[i].setAttribute('index', i);
            divs[i].addEventListener('click', function () {
                var index = ~~this.getAttribute('index') + 1;
                if (callback && typeof(callback) == 'function') {
                    callback({buttonIndex: index});
                    confirmHide();
                }
            }, false);
        }
        document.getElementById("confirmbackground").addEventListener('click', function () {
            confirmHide();
        }, false);
        document.getElementById("confirmbackground").addEventListener('click', function () {
            event.stopPropagation();
            event.preventDefault();
        }, false);
        function confirmHide() {
            document.getElementById("confirmbackground").style.display = 'none';
            document.getElementById("confirmContainer").style.display = 'none';
        }
    }

    //吐丝
    var toastTimer = null;

    function toast(obj) {
        if (document.getElementById("toastContainer")) {
            document.body.removeChild(document.getElementById("toastContainer"));
        }
        if (obj.location == 'top') {
            var duration = 'top:20px;';
            var translate = '-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);transform: translateX(-50%);';
        } else if (obj.location == 'middle') {
            var duration = 'top:50%;';
            var translate = '-webkit-transform: translateX(-50%) translateY(-50%);-moz-transform: translateX(-50%) translateY(-50%);-ms-transform: translateX(-50%) translateY(-50%);-o-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);';
        } else if (obj.location == 'bottom') {
            var duration = 'bottom:20%;';
            var translate = '-webkit-transform: translateX(-50%) translateY(-50%);-moz-transform: translateX(-50%) translateY(-50%);-ms-transform: translateX(-50%) translateY(-50%);-o-transform: translateX(-50%) translateY(-50%);transform: translateX(-50%) translateY(-50%);';
        } else {
            var duration = 'top:50%;';
            var translate = '-webkit-transform: translateX(-50%);-moz-transform: translateX(-50%);-ms-transform: translateX(-50%);-o-transform: translateX(-50%);transform: translateX(-50%);';
        }
        var seed = (obj.duration / 1000) || 2;
        var location = '-webkit-animation: toastFrames 1s ' + seed + 's forwards;-moz-animation: toastFrames 1s' + seed + 's forwards;-ms-animation: toastFrames 1s ' + seed + 's forwards;-o-animation: toastFrames 1s forwards' + seed + 's;animation: toastFrames 1s ' + seed + 's forwards;';

        var style = '<style>@-webkit-keyframes toastFrames{from{opacity: 1;}to{opacity: 0;display:none;}}@-moz-keyframes toastFrames{from{opacity: 1;}to{opacity: 0;display:none;}}@-o-keyframes toastFrames{from{opacity: 1;}to{opacity: 0;display:none;}}@-ms-keyframes toastFrames{from{opacity: 1;}to{opacity: 0;display:none;}}</style>';

        var html = style + '<div id="toastContainer" style="position: fixed;' + duration + 'left: 50%;	width: 100%;z-index: 9999999;text-align: center;' + translate + location + '"><span style="display: inline-block;	max-width: 80%;padding: 10px 20px;border-radius: 7px;word-break:break-all;word-wrap:break-word;background-color: rgba(0,0,0,0.5);color: #fff;" id="toastText"></span></div>';

        document.body.insertAdjacentHTML('beforeEnd', html);
        document.getElementById("toastText").innerText = obj.msg;
        document.getElementById("toastContainer").addEventListener('touchmove', function () {
            event.stopPropagation();
            event.preventDefault();
        }, false);
        if (toastTimer) {
            clearTimeout(toastTimer);
        }
        var timeout = parseInt((seed + 1) * 1000);
        toastTimer = setTimeout(function () {
            if (document.getElementById("toastContainer")) {
                document.body.removeChild(document.getElementById("toastContainer"));
            }
        }, timeout);
    }

    //显示进度图层
    function showProgress(obj) {
        if (obj) {
            var rgba = obj.rgba || 0.3;
        } else {
            var rgba = 0.3;
        }

        if (document.getElementById("showProgressContainer")) {
            document.getElementById("showProgressBackground").style.display = 'block';
            document.getElementById("showProgressContainer").style.display = 'block';
            document.getElementById("showProgressBackground").removeEventListener("touchstart", showProgressTouch);
            document.getElementById("showProgressBackground").removeEventListener("touchmove", showProgressTouch);
        } else {
            var html = '<div id="showProgressBackground" style="position: fixed;width: 100%;height: 100%;left: 0;top: 0;background-color: rgba(0,0,0,' + rgba + ');z-index:999999"></div><div id="showProgressContainer" style="position: fixed;left: 50%;top: 50%;-webkit-transform:  translateX(-50%) translateY(-50%);-moz-transform:  translateX(-50%) translateY(-50%);-ms-transform:  translateX(-50%) translateY(-50%);-o-transform:  translateX(-50%) translateY(-50%);transform:  translateX(-50%) translateY(-50%);background-color: rgba(0,0,0,1);color: #fff;padding: 15px;border-radius: 5px;text-align: center;min-height: 115px;min-width: 115px;z-index:999999"><div class="showProgressLoading"></div><div id="showProgressTitle" style="padding: 5px 0;color:#fff"></div><div id="showProgressText" style="color:#fff"></div></div>';

            document.body.insertAdjacentHTML('beforeEnd', html);
        }
        if (obj) {
            var title = obj.title || '努力加载中...';
            var text = obj.text || '请稍候...';
            var modal = obj.modal || true;
        } else {
            var title = '努力加载中...';
            var text = '请稍候...';
            var modal = true;
        }
        document.getElementById("showProgressTitle").innerHTML = title;
        document.getElementById("showProgressText").innerHTML = text;

        if (modal) {
            document.getElementById("showProgressBackground").addEventListener('touchstart', showProgressTouch, false);
            document.getElementById("showProgressBackground").addEventListener('touchmove', showProgressTouch, false);
        }
    }

    function showProgressTouch() {
        event.stopPropagation();
        event.preventDefault();
    }

    //隐藏进度图层
    function hideProgress() {
        if (document.getElementById("showProgressContainer")) {
            document.getElementById("showProgressBackground").style.display = 'none';
            document.getElementById("showProgressContainer").style.display = 'none';
        }
    }

    function getTime(time) {
        if (time) {
            var yy = time.getYear() + 1900;
            var MM = time.getMonth() + 1;
            var dd = time.getDate();
            var HH = time.getHours();
            var mm = time.getMinutes();
            var ss = time.getSeconds();

            return yy + "-" + bl(MM) + "-" + bl(dd) + " " + bl(HH) + ":" + bl(mm) + ":" + bl(ss);
        }
        else {
            time = new Date();
            var yy = time.getYear() + 1900;
            var MM = time.getMonth() + 1;
            var dd = time.getDate();
            var HH = time.getHours();
            var mm = time.getMinutes();
            var ss = time.getSeconds();

            return yy + "-" + bl(MM) + "-" + bl(dd) + " " + bl(HH) + ":" + bl(mm) + ":" + bl(ss);
        }
    }

    function bl(s) {
        return s < 10 ? '0' + s : s;
    }

    return {
        alert: alert,
        confirm: confirm,
        toast: toast,
        showProgress: showProgress,
        hideProgress: hideProgress,
        repeat: repeat,
        getTime: getTime
    };
})();