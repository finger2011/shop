<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/7/5
 * Time: 下午10:46
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;
use app\api\validate\TestValidate;

class Banner
{
    public function getBanner($id){
        $data = [
            'id' => $id
        ];
        $validate = new IDMustBePositiveInt();
        $result = $validate->batch()->check($data);
        var_dump($validate->getError());
    }

}