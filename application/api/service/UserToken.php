<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/18
 * Time: 下午12:31
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;

use app\api\model\User as UserModel;
use think\Log;

class UserToken extends Token
{
    protected $code;

    protected $wxAppID;

    protected $wxAppSecret;

    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),
            $this->wxAppID, $this->wxAppSecret, $this->code);
    }

    public function get() {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);
        if(empty($wxResult)) {
            throw new Exception('获取session_key及openID时异常，微信内部错误');
        } else {
            $loginResult = array_key_exists('errcode', $wxResult);
            if($loginResult) {
                $this->processLoginError($wxResult);
            } else {
                return $this->grantToken($wxResult);
            }
        }
    }

    private function grantToken($wxResult) {
        //get openid
        $openid = $wxResult['openid'];
        //check openid in database,get/create user id
        $user = UserModel::getByOpenID($openid);
        if($user) {
            $userId = $user->id;
        } else {
            $userId = $this->newUser($openid);
        }
        //create&save token into cache
        $cacheValue = $this->prepareCacheValue($wxResult, $userId);
        $token = $this->saveToCache($cacheValue);
        return $token;
    }

    private function saveToCache($cacheValue) {
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        $expire = config('setting.token_expire_in');

        $request = cache($key, $value, $expire);
        if(!$request) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }

    private function prepareCacheValue($wxResult, $userId) {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $userId;
        $cacheValue['scope'] = ScopeEnum::USER;
        return $cacheValue;
    }

    private function newUser($openid) {
        $user = UserModel::create([
            'openid' => $openid
        ]);
        return $user->id;
    }

    private function processLoginError($wxResult) {
        throw new WeChatException(
            [
                'msg' => $wxResult['errmsg'],
                'errorCode' => $wxResult['errcode']
            ]);
    }

}