<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/20
 * Time: 下午11:07
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id', 'delete_time', 'update_time'];

    protected $autoWriteTimestamp = true;

//    protected $createTime = 'xxxx';

}