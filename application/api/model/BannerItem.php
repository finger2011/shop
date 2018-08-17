<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/17
 * Time: 上午8:32
 */

namespace app\api\model;


use think\Model;

class BannerItem extends Model
{
    protected $hidden = ['id','img_id','banner_id','update_time','delete_time'];

    public function img()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}