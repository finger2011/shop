<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/18
 * Time: 下午12:30
 */

namespace app\api\model;


class User extends BaseModel
{
    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getByOpenID($openid) {
        $user = self::where('openid', '=', $openid)
            ->find();
        return $user;
    }

}