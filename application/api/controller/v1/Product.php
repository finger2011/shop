<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/18
 * Time: 上午10:47
 */

namespace app\api\controller\v1;


use app\api\validate\Count;

class Product
{
    public function getRecent($count=15)
    {
        (new Count())->goCheck();
        return 'success';
    }
}