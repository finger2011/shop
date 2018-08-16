<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/7/5
 * Time: 下午10:46
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;

class Banner
{
    public function getBanner($id)
    {
        (new IDMustBePositiveInt())->goCheck();
    }

}