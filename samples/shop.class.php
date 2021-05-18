<?php

use NaverShopEp\Shop\AbstractItem;
use NaverShopEp\Shop\AbstractLists;

/**
 * Class ShopLists
 * 각 쇼핑몰에 맞게 NaverShopEp\Shop\AbstractLists 확장하여 쿼리 넣어주시면 됩니다.
 */
class ShopLists extends AbstractLists {

    /**
     * 주문판매상태 고려 전송하고자 하는 상품 선택 쿼리
     * 전송되는 정보 고려 (변경시 업데이트 필요) item_hash 작성
     * @return string
     */
    public function queryAll()
    {
        $query = "SELECT s_idx as uid, s_goods_name, s_category, s_img_url, s_price, IF(s_stock>0,1,0) as is_stock, s_status, s_last_update,
                        md5(CONCAT(s_goods_name, s_category, s_img_url, s_price, s_status, IF(s_stock>0,1,0))) as item_hash
                FROM shop_item WHERE s_status = 1 AND s_nshop_flag = 'Y' ORDER BY s_idx ASC LIMIT 10
                ";
        return $query;
    }
}

/**
 * Class ShopLists
 * 각 쇼핑몰에 맞게 NaverShopEp\Shop\AbstractItem 확장하여 데이터 맞춰주시면 됩니다.
 */
class ShopItem extends AbstractItem {

    public function getId()
    {
        return $this->data['uid'];
    }

    public function getCategory_name1()
    {
        return $this->data['s_category'];
    }

    public function getImage_link()
    {
        return 'http://sample.com'.$this->data['s_img_url'];
    }

    public function getLink()
    {
        return 'http://sample.com/goods/detail?gno='.$this->data['uid'];
    }

    public function getMobile_link()
    {
        return 'http://sample.com/goods/detail?gno='.$this->data['uid'];
    }

    public function getPrice_pc()
    {
        return $this->data['s_price'];
    }

    public function getShipping()
    {
        return 0;
    }

    public function getTitle()
    {
        return $this->data['s_goods_name'];
    }
}

