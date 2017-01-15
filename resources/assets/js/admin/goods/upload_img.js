/* 图片的标识ID,对应下面 图片json中的数组的索引 */
/* 图片的json类：  {"path":[{"图片路径"},{"..."},...],"thumbPath":[{"缩略图路径"},{...} , ...]} */
var picJson = {};
picJson.path = [];
picJson.thumbPath = [];

/**
 * 上传成功之后调用此方法追加图片到后面
 * @param {type} id 图片id
 * @param {type} path 图片路径
 * @param {type} thumbPath 缩略图路径
 * @param {type} showPicDiv 用于显示的 div 的 id
 * @param {type} width 宽
 * @param {type} height 高
 * @returns {undefined}
 */
function uploadPicSucceed(id, path, thumbPath, showPicDiv, width, height) {
    var momWidth = width + 60;
    var momHeight = height + 10;

    var str = "<div id=\"item_" + id + "\" class=\"item_pic_mom\" data-id=\""+id+"\">" +
        "<div class=\"item_pic_left\">" +
        "<img src=\"" + path + "\"/></div>" +
        "<div class=\"item_pic_right\">" +
        "<a href=\"#\"  onclick=\"javascript:deletePic(" + id + ");\" style=\"color: gray;\">删除</a></div></div>";

    $(str).appendTo($("#" + showPicDiv)); // 追加显示图片

    picJson.path[id] = path; // 保存图片路径
    picJson.thumbPath[id] = thumbPath;

}

/**
 *
 * @param {type} picID
 * @returns {type} 移除的图片路径
 */
function deletePic(picID) {

    var path = "";

    path = $("#item_" + picID + " img").attr("src");
    $("#item_" + picID).fadeOut();

    picJson.path[picID] = null;
    picJson.thumbPath[picID] = null;

    console.log(picJson);

    return path;

}
