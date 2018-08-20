<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/20
 * Time: 上午8:20
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不足';
    public $errorCode = 10001;

}