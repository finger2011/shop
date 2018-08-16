<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/16
 * Time: 上午8:30
 */

namespace app\api\validate;


use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取所有参数
        $request = Request::instance();
        $params = $request->param();

        //校验参数
        $result = $this->check($params);
        if(!$result) {
            $error = $this->error;
            throw new Exception($error);
        } else {
            return true;
        }
    }

}