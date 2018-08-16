<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/7/5
 * Time: 下午10:46
 */

namespace app\api\controller\v1;


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
     * @return array
     * @throws
     */
    public function getBanner($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $banner = BannerModel::getBanner();
        if(!$banner) {
            throw new BannerMissException();
        }


        return $banner;
    }

}