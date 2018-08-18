<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/18
 * Time: 下午1:17
 */

namespace app\api\service;


class Token
{
    public static function generateToken() {
        $randChars = getRandChar(32);

        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];

        $salt = config('secure.token_salt');

        return md5($randChars.$timestamp.$salt);
    }

}