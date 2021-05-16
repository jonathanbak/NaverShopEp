<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 네이버가격비교페이지ID(정수10~12자리)를입력하셔야하며,유효하지않은값은처리되지않습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Naver_product_id extends TypeAbstract
{
    protected $_maxsize = 50;
    protected $_condition = '[0-9]{10,12}';
}