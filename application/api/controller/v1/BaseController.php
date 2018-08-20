<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/20
 * Time: 上午8:35
 */

namespace app\api\controller\v1;


use app\api\service\Token as TokenService;
use think\Controller;

class BaseController extends Controller
{
    protected function checkPrimaryScope() {
        TokenService::needPrimaryScope();
    }

    protected function checkExclusiveScope() {
        TokenService::needExclusiveScope();
    }

}