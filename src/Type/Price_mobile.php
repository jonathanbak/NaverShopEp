<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• price 컬럼과 동일 기준/포맷
• 모바일상품가를가지고있는상품에표기하여야합니다.
• 모바일에 PC가격과 다른 가격을 오류 없이 노출하려면 전체EP및 요약 EP에 price_pc 컬럼과 price_mobile 컬럼을 반드시 함께 사용하여 합니다.(필수)
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Price_mobile extends TypeAbstract
{
    protected $_maxSize = 10;
    protected $_condition = '([1-9]{1}|[0-9]{2,10})';
}