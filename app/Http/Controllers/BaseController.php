<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    protected $errorCode = 0;
    protected $errorMsg = '';
    protected $responseData;


    public $errorTexts = array(
        0 => 'OK',
        1 => '系统错误',
        4000 => '接口加密错误',
        4001 => 'Created',
        4003 => '无效refresh_token',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
    );

    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function setErrorMsg($errorMsg)
    {
        $this->errorMsg = $errorMsg;
    }

    public function getErrorMsg()
    {
        return $this->errorMsg;
    }

    public function setResponseData($data){
        $this->responseData=$data;
    }

    public function getResponseData(){
        return $this->responseData;
    }

    public function setErrorResponse($errorCode, $errorMsg = '')
    {
        $this->setErrorCode($errorCode);
        if ($errorMsg)
        {
            $this->setErrorMsg($errorMsg);
        } else
        {
            $this->setErrorMsg($this->errorTexts[$errorCode]);
        }

    }

    public function response()
    {
        if ($this->errorCode)
        {
            return $this->jsonFailResponse($this->errorMsg,$this->errorCode);
        }
        return $this->jsonSuccessResponse($this->responseData);
    }

    /*
     * json输出接口
     * @param  int  $status
     * @param  string  $errorMsg
     * @param  array  $data
     *
     * @return \Illuminate\Http\Response
     */
    public function jsonResponse($errorCode, $errorMsg, $data)
    {
        return response()->apiJson($errorCode, $errorMsg, $data);
    }


    /**
     * success response json
     *
     * @param array $data
     */
    public function jsonSuccessResponse($data = [])
    {
        if (empty($data))
        {
            $data = new \stdClass();
        }
        return $this->jsonResponse(0, '', $data);
    }

    /**
     * fail response json
     *
     * @param $errorMsg
     * @param int $errorCode
     */
    public function jsonFailResponse($errorMsg, $errorCode = 1)
    {
        return $this->jsonResponse($errorCode, $errorMsg, new \stdClass());
    }
}
