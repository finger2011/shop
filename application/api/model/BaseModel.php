<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    //
    protected function prefixImgUrl($value, $data)
    {
        $url = $value;
        if(1 == $data['from']) {
            $url = config('setting.img_prefix'). '/images' .$value;
        }
        return $url;
    }
}
