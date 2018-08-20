<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/20
 * Time: 上午8:27
 */

namespace app\api\controller\v1;


use app\api\validate\OrderPlace;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;

class Order extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder() {
        (new OrderPlace())->goCheck();

        $products = input('post.products/a');
        $uid = TokenService::getCurrentTokenVar('uid');

        $order = new OrderService();
        $status = $order->place($uid, $products);
        return $status;
    }

}