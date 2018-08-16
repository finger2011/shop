<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/16
 * Time: 下午10:19
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    //HTTP状态码
    public $code = 400;

    // 错误具体信息
    public $msg = 'error param';

    //自定义错误码
    public $errorCode = 10000;

    public function __construct($param = [])
    {
        if(!is_array($param)) {
            return;
        }
        if(array_key_exists('code', $param)) {
            $this->code = $param['code'];
        }
        if(array_key_exists('msg', $param)) {
            $this->msg = $param['msg'];
        }
        if(array_key_exists('errorCode', $param)) {
            $this->errorCode = $param['errorCode'];
        }
    }

}