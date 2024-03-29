<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Image extends Model
{

    /**
     * TODO 使用文件系统
     */

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    const ACCESS_KEY = 'mrqZWq_gBAWW6Mb8Emkwfq7cltH9kWZ7j54Dwp0g';
    const SECRET_KEY = '9x4dFeM68b0CT9pg4tOqYXpe1q9-Le3Yj3RibfQD';
    const BUCKET_NAME = 'limit';


    public static function upload(UploadedFile $img)
    {
        $auth = new Auth(self::ACCESS_KEY, self::SECRET_KEY);
        // 生成上传 Token
        $token = $auth->uploadToken(self::BUCKET_NAME);

        $storageFileName = time() . rand(1000, 9999) . '.' . $img->getClientOriginalExtension();
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $storageFileName, $img->getPathname());
        if ($err !== null) {
//            var_dump($err);//图片上传失败,写入日志
            return false;
        }
        return $storageFileName;
//        return self::baseUrl($ret['key']);
    }


    public static function baseUrl($name)
    {
        $base_url = 'http://oi7him8kd.bkt.clouddn.com/' . $name;
        return $base_url;
    }

    public static function privateUrl($name)
    {
        $auth = new Auth(self::ACCESS_KEY, self::SECRET_KEY);
        return $auth->privateDownloadUrl(self::baseUrl($name));
    }

}
