<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/18
 * Time: 下午1:58
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\model\UserAddress;
use app\api\service\Token as TokenService;
use app\api\validate\AddressNew;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;

class Address extends BaseController
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress，getUserAddress']
    ];

    public function createOrUpdateAddress() {
        $validate = new AddressNew();
        $validate->goCheck();

        //get user id
        $uid = TokenService::getCurrentUid();

        //check user exist
        $user = UserModel::get($uid);
        if(!$user) {
            throw new UserException();
        }

        //get address data
        $addressData = $validate->getDataByRule(input('post.'));

        //create or update address
        $userAddress = $user->address;
        if(!$userAddress) {
            $user->address()->save($addressData);
        } else {
            $user->address->save($addressData);
        }

        return json(new SuccessMessage(), 201);
    }

    public function getUserAddress(){
        $uid = TokenService::getCurrentUid();
        $userAddress = UserAddress::where('user_id', $uid)
            ->find();
        if(!$userAddress){
            throw new UserException([
                'msg' => '用户地址不存在',
                'errorCode' => 60001
            ]);
        }
        return $userAddress;
    }

}