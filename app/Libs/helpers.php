<?php

/**
 * Created by PhpStorm.
 * User: hiho
 * Date: 17-1-22
 * Time: 下午1:20
 */
if (!function_exists('getRandomStr')) {
    function getRandomStr($length = 6, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
    {
        // 密码字符集，可任意添加你需要的字符
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            // 这里提供两种字符获取方式
            // 第一种是使用 substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组 $chars 的任意元素
            // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
            $random .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $random;
    }
}

if (!function_exists('http_post')) {
    function http_post($url, $param, $timeout = 0)
    {
        $oCurl = curl_init();
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (is_string($param)) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach ($param as $key => $val) {
                $aPOST[] = $key . "=" . urlencode($val);
            }
            $strPOST = join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $strPOST);
        if (!empty($timeout)) {
            curl_setopt($oCurl, CURLOPT_TIMEOUT, $timeout);
        }

        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if (intval($aStatus["http_code"]) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }
}

if (!function_exists('yunPainTplSendSms')) {
    function yunPainTplSendSms($tplId, $phone, $content)
    {
        $apikey = "283551ad582447d692982a68a33693dc";
        $url = "http://yunpian.com/v1/sms/tpl_send.json";
        $encoded_tpl_value = urlencode("$content");
        $post_string = "apikey=$apikey&tpl_id=$tplId&tpl_value=$encoded_tpl_value&mobile=$phone";
        $result = http_post($url, $post_string);
        return $result;
    }
}
