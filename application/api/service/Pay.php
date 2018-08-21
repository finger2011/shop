<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/20
 * Time: 下午11:42
 */

namespace app\api\service;


use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class Pay
{
    private $orderID;
    private $orderNO;

    function __construct($orderID){
        if (!$orderID) {
            throw new Exception('订单号不允许为NULL');
        }
        $this->orderID = $orderID;
    }

    public function pay() {

        //check order exist
        self::checkOrderValid();
        //check order stock
        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderID);
        if(!$status['pass']) {
            return $status;
        }
        return self::makeWxPreOrder($status['orderPrice']);
    }

    private function makeWxPreOrder($totalPrice) {
        $openid = Token::getCurrentTokenVar('openid');
        if(!$openid) {
            throw new TokenException();
        }
        $wxConfig = new WxPayConfig();
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNO);
        $wxOrderData->SetTrade_type('JSAPI');
        $wxOrderData->SetTotal_fee($totalPrice * 100);
        $wxOrderData->SetBody(config('secure.project_name'));
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url(config('secure.pay_back_url'));
        return $this->getPaySignature($wxConfig, $wxOrderData);
    }

    private function getPaySignature($wxConfig, $wxOrderData)
    {
        $wxOrder = \WxPayApi::unifiedOrder($wxConfig, $wxOrderData);
        if ($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] != 'SUCCESS') {
            Log::record($wxOrder, 'error');
            Log::record('获取预支付订单失败', 'error');
            throw new WeChatException([
                'msg' => $wxOrder['return_msg'],
                'errorCode' => 999
            ]);
        }
        //prepay_id
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxConfig, $wxOrder);
        return $signature;
    }

    private function sign($wxConfig, $wxOrder){
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string)time());

        $rand = md5(time() . mt_rand(0, 1000));
        $jsApiPayData->SetNonceStr($rand);

        $jsApiPayData->SetPackage('prepay_id='.$wxOrder['prepay_id']);
        $jsApiPayData->SetSignType('md5');

        $sign = $jsApiPayData->MakeSign($wxConfig);
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;

        unset($rawValues['appId']);

        return $rawValues;
    }

    private function recordPreOrder($wxOrder){
        OrderModel::where('id', '=', $this->orderID)
            ->update(['prepay_id' => $wxOrder['prepay_id']]);
    }

    private function checkOrderValid() {
        $order = OrderModel::where('id', '=', $this->orderID)
            ->find();
        if(!$order) {
            throw new OrderException();
        }
        if(!Token::isValidOperate($order->user_id)) {
            throw new TokenException([
                'msg' => '订单与用户不匹配',
                'errorCode' => 10003
            ]);
        }
        if(OrderStatusEnum::UNPAID != $order->status) {
            throw new OrderException([
                'msg' => '订单已支付过啦',
                'errorCode' => 80003,
                'code' => 400
            ]);
        }
        $this->orderNO = $order->order_no;
        return true;
    }



}