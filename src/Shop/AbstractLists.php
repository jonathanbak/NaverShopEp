<?php
/**
 * 네이버샵 EP생성용 데이터 관리 EP 3.0
 * queryAll 예시 : select idx as uid,column1,column2,md5(CONCAT(column1,column2,IF(stock<1, 1, 0))) as item_hash from item_table where stock > 0 limit 100
 * Author: jonathanbak
 */
namespace NaverShopEp\Shop;

abstract class AbstractLists
{
    /**
     * 네이버샵 EP FULL 목록
     * 필수 필드 : uid, item_hash
     * @return string
     */
    abstract public function queryAll();
}