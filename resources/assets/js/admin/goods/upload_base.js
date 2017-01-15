function upload_img(url,file_id,img_id,hidden_id,hidden_thumb_id,default_img_url){
    
    $('#'+file_id).fileupload({
        url: url,
        dataType: 'json',
        add: function (e, data) {
            /*提示*/
            /*fire to upload*/
            data.submit(); // 直接上传
        },
        done: function (e, data) { // 上传完毕

            if (data.jqXHR.responseJSON.result === true)
            {
//                {"color": "green", "border-color": "green", "background": "#d9f7e6"}
//                displayTip("green", "green", "#d9f7e6", "上传成功");
//                setTimeout(function () {
//                    $("#message_wraper").fadeOut();
//                }, 3000);

                var headImg = data.jqXHR.responseJSON.path;
                var thumb = data.jqXHR.responseJSON.thumb;
                $('#'+img_id).attr('src', headImg);
                $("#"+hidden_id).val(headImg);
                
                if(hidden_thumb_id != undefined) {
                    $("#"+hidden_thumb_id).val(thumb);
                }
                /*data.jqXHR.responseJSON.path*/
            } else {
//                displayTip("#fc8383", "#fc8383", "#fbeded", data.jqXHR.responseJSON.info);
                swal(data.jqXHR.responseJSON.info,'','warning');

//                var picPath = data.jqXHR.responseJSON.pic;
                if(default_img_url == undefined) {
                    $('#'+img_id).attr('src', statics_url + "/images/upload_comn.png");
                }
//                $("#"+hidden_id).val(picPath);
                /*失败*/
            }

        },
        fail: function (e, data) {
//            displayTip("#fc8383", "#fc8383", "#fbeded", "请求失败");
            swal('请求失败','','warning');
            if(default_img_url == undefined) {
                    $('#'+img_id).attr('src', statics_url + "/images/upload_comn.png");
            }
        },
        progressall: function (e, data) { //设置上传进度事件的回调函数
//            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#'+img_id).attr('src', statics_url + '/images/big_load.gif');
        }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

}

function upload_img_1(url,file_id,call_back_func){
    //xw_loader.start();
    $('#'+file_id).fileupload({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: url,
        dataType: 'json',
        add: function (e, data) {
            /*提示*/
            /*fire to upload*/
            data.submit(); // 直接上传
        },
        done: function (e, data) { // 上传完毕
            xw_loader.end();
            call_back_func(data.jqXHR.responseJSON);
        },
        fail: function (e, data) {
            xw_loader.end();
            call_back_func(data.jqXHR.responseJSON);
        },
        progressall: function (e, data) { //设置上传进度事件的回调函数
//            var progress = parseInt(data.loaded / data.total * 100, 10);
//            swal('正在上传 ... ','','warning');
            xw_loader.start();
        }
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

}


