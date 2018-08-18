<?php

namespace app\api\model;

use think\Model;

class Image extends Model
{
    protected $hidden = ['id', 'from', 'delete_time','update_time'];
    //

    public function getUrlAttr($value, $data)
    {
        $url = $value;
        if(1 == $data['from']) {
            $url = config('setting.img_prefix').$value;
        }
        return $url;
    }
}
