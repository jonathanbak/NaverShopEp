<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 * 그룹ID
• 소셜커머스몰상품중구매옵션이분리된상품들에메인상품의ID를입력합니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Group_id extends TypeAbstract
{
    protected $_maxsize = 50;
    protected $_condition = '([0-9a-zA-Z]+)';
}