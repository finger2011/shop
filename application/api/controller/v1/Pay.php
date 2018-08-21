<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/20
 * Time: 下午11:37
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\WxNotify;
use app\api\service\WxPayConfig;
use app\api\validate\IDMustBePositiveInt;
use app\api\service\Pay as PayService;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    public function getPreOrder($id = '') {
        (new IDMustBePositiveInt())->goCheck();

        $pay = new PayService($id);
        return $pay->pay();
    }

    public function receiveNotify() {

        $notify = new WxNotify();
        $notify->Handle(new WxPayConfig());
    }
}