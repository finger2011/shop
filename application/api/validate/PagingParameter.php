<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/21
 * Time: 下午9:39
 */

namespace app\api\validate;


class PagingParameter extends BaseValidate
{

    protected $rule = [
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger'
    ];

    protected $message = [
        'page' => '分页参数必须是正整数',
        'size' => '分页参数必须是正整数'
    ];
}