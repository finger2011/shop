<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/18
 * Time: 下午12:39
 */
return [
    'app_id' => 'wxe1562d54b773201b',
    'app_secret' => 'ce62183003742226874a352ad0584e12',
    'login_url'=> "https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s",

];