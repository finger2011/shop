<?php
/**
 * Created by PhpStorm.
 * User: qiqizhang
 * Date: 2018/8/20
 * Time: 上午8:48
 */

namespace app\api\service;


use app\api\model\Product;

class Order
{
    protected $outProducts;

    protected $DBProducts;

    protected $uid;

    public function place($uid, $outProducts) {
        $this->uid = $uid;
        $this->outProducts = $outProducts;
        $this->DBProducts = self::getProductByOrder($outProducts);
    }

    private function getProductByOrder($outProducts) {
        $outIDs = [];
        foreach ($outProducts as $product) {
            array_push($outIDs, $product['product_id']);
        }
        $products = Product::all([$outIDs])
            ->visible(['id', 'price', 'stock', 'name', 'main_img_url'])
            ->toArray();
        return $products;
    }


}