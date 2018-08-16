<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/16
 * Time: 下午11:09
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    //HTTP状态码
    public $code = 400;

    // 错误具体信息
    public $msg = 'error param';

    //自定义错误码
    public $errorCode = 10000;

}