<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/16
 * Time: 上午8:38
 */

namespace app\api\model;


use think\Db;
use think\Model;

class Banner extends Model
{
    protected $hidden = ['update_time','delete_time'];

    public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerByID($id)
    {
        $result = self::with(['items', 'items.img'])->find($id);
        return $result;
    }

}