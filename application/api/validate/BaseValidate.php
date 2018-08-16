<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/16
 * Time: 上午8:30
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
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
        $result = $this->batch()->check($params);
        if(!$result) {
            throw new ParameterException([
                'msg' => $this->error
            ]);
        } else {
            return true;
        }
    }

}