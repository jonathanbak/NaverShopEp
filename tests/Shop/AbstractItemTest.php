<?php

namespace NaverShopEpTest\Shop;

use NaverShopEp\Shop\AbstractItem;


class ShopItem extends AbstractItem {

    public function getId()
    {
        return $this->data['uid'];
    }

    public function getCategory_name1()
    {
        return $this->data['category'];
    }

    public function getImage_link()
    {
        return $this->data['img_url'];
    }

    public function getLink()
    {
        return $this->data['goods_url'];
    }

    public function getMobile_link()
    {
        return $this->data['goods_url'];
    }

    public function getPrice_pc()
    {
        return $this->data['price'];
    }

    public function getShipping()
    {
        return 0;
    }

    public function getTitle()
    {
        return $this->data['goods_name'];
    }
}

/**
 * Shop\Item
 */
class AbstractItemTest extends \PHPUnit\Framework\TestCase
{
    public function itemProviders()
    {
        return [
            [
                [
                    'uid'=>111,
                    'category'=>'상품분류1',
                    'img_url'=>'http://example.com/image/1.jpg',
                    'goods_url'=>'http://example.com/item/detail?id=1',
                    'price'=>3000,
                    'goods_name'=>'상품명',
                    'stock'=>1,
                    'item_hash'=>md5(implode('',['상품분류1','http://example.com/image/1.jpg','http://example.com/item/detail?id=1',3000,'상품명',1]))
                ]
            ]
        ];
    }

    /**
     * @dataProvider itemProviders
     * @param $data
     */
    public function testClassInstance($data)
    {
        $ShopItem = new ShopItem($data);

        $this->assertTrue($ShopItem->getTitle() == '상품명');
    }

}