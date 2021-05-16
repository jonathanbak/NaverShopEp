<?php
/**
 * 네이버샵 EP생성용 데이터 관리 EP 3.0
 * Author: jonathanbak
 */
namespace NaverShopEp;

use NaverShopEp\Shop\AbstractLists;

class ItemManage
{
    /**
     * 네이버샵 전송 상품정보 입력
     * @param array $params
     * @return bool|integer
     */
    public function add( $params )
    {
        $allowModifyColumns = array('ne_uid', 'ne_send_status', 'ne_send_date', 'ne_reg_date', 'ne_item_hash');
        $setDatas = array();
        foreach($params as $key => $value){
            if(in_array($key, $allowModifyColumns)) $setDatas[$key] = $value;
        }

        $setDatas = SqlHelper::arrayToRealEscape($setDatas);

        $query = "INSERT INTO nshop_epitem SET ne_uid = '".$setDatas['ne_uid'] . "', 
                        ne_item_hash = '".$setDatas['ne_item_hash']."', ne_send_date = now()
                    ON DUPLICATE KEY UPDATE ne_send_date = now(), ne_item_hash = '".$setDatas['ne_item_hash']."' ";
        return $query;
    }

    /**
     * 네이버샵 전송한 상품과 변경된 정보 있는 상품 가져오는 쿼리
     * @param Shop\AbstractLists $ShopList
     * @return string
     */
    public function getChangeListQuery(Shop\AbstractLists $ShopList)
    {
        $shopFullList = $ShopList->queryAll();
        $query = "SELECT ei.*,i.*
            FROM nshop_epitem ei, (".$shopFullList.") i 
            WHERE ei.ne_uid = i.uid AND ei.`ne_send_date` > DATE_FORMAT(now(),'%Y-%m-%d 00:00:00') AND ei.ne_item_hash != i.item_hash;";
        //AND ei.ne_str !=  md5(CONCAT(i.column1,i.column1,IF(i.count<1, 1, 0)))
        return $query;
    }

    /**
     * 네이버샵 전송할 EP FULL 목록
     * 바로 상품 쿼리 사용해도 이상무
     * @param Shop\AbstractLists $ShopList
     * @return string
     */
    public function getAllQuery(Shop\AbstractLists $ShopList)
    {
        $query = $ShopList->queryAll();
        return $query;
    }

    /**
     * EP FULL 목록 이후 추가된 상품
     * @param Shop\Lists $ShopList
     * @return string
     */
    public function getNewListQuery(Shop\AbstractLists $ShopList)
    {
        $shopFullList = $ShopList->queryAll();
        $query = "SELECT i.*
                    FROM (".$shopFullList.") i LEFT JOIN nshop_epitem ei ON i.uid = ei.ne_uid AND ei.ne_send_date >= DATE_FORMAT(now(),'%Y-%m-%d 00:00:00') 
                  WHERE ei.ne_uid IS NULL 
                    ";
        return $query;
    }

}