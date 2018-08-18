<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/7/5
 * Time: 下午10:46
 */

namespace app\api\controller\v2;


use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;

class Banner
{

    /**
     * 根据id获取banner信息
     * @url /banner/:id
     * @http GET
     * @param $id int banner的id
     */
    public function getBanner($id)
    {
        echo 'this is v2 banner';
    }

}