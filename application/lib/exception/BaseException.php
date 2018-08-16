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

}