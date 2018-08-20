<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/18
 * Time: 下午2:20
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;

}