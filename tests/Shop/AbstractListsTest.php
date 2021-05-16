<?php

namespace NaverShopEpTest\Shop;

use NaverShopEp\ItemManage;
use NaverShopEp\Shop\AbstractLists;


class ShopLists extends AbstractLists {

    /**
     * 주문판매상태 고려 전송하고자 하는 상품 선택 쿼리
     * 전송되는 정보 고려 (변경시 업데이트 필요) item_hash 작성
     * @return string
     */
    public function queryAll()
    {
        $query = "SELECT s_idx as uid, s_goods_name, s_img_url, s_price, IF(s_stock>0,1,0) as is_stock, s_status, s_last_update,
                        md5(CONCAT(s_goods_name, s_img_url, s_price, IF(s_stock>0,1,0))) as item_hash
                FROM shop_item WHERE s_status = 1 AND s_nshop_flag = 'Y' LIMIT 5
                ";
        return $query;
    }
}

/**
 * Shop\Item
 */
class AbstractListsTest extends \PHPUnit\Framework\TestCase
{

    public function testClassInstance()
    {
        $ShopLists = new ShopLists();
        $ItemManager = new ItemManage();
        $query = $ItemManager->getAllQuery($ShopLists);

        $this->assertTrue(strlen($query)>0);
    }

}