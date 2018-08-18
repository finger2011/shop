<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/16
 * Time: 上午8:19
 */

namespace app\api\validate;


use think\Validate;

class IDMustBePositiveInt extends BaseValidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];

    protected $message = [
        'id' => 'id必须为正整数'
    ];


}