<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/18
 * Time: 下午12:24
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code = '') {
        (new TokenGet())->goCheck();

        $userToken = new UserToken($code);
        $token = $userToken->get();

        return [
            'token' => $token
        ];
    }

}