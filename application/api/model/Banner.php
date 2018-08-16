<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/16
 * Time: 上午8:38
 */

namespace app\api\model;


use think\Db;

class Banner
{

    public static function getBanner($id)
    {
        $result = Db::table('banner_item')
            ->where('banner_id', '=', $id)
            ->select();
        return $result;
    }

}