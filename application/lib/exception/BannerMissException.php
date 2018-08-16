<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/16
 * Time: 下午10:21
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    //HTTP状态码
    public $code = 404;

    // 错误具体信息
    public $msg = 'banner id not exists!';

    //自定义错误码
    public $errorCode = 10000;

}