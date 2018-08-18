<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/18
 * Time: 上午10:05
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids必须是以逗号分隔的多个正整数'
    ];

    protected function checkIDs($value, $rule = '', $data, $field = ''){
        $values = explode(',', $value);
        if(empty($values)) {
            return false;
        }
        foreach ($values as $id) {
            if(!$this->isPositiveInteger($id, $rule = '', $data, $field = '')) {
                return false;
            }
        }
        return true;
    }
}