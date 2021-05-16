<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 상품가격과기준동일
• 할인이전가격과같거나정가가없는경우에는표기하지않습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Normal_price extends TypeAbstract
{
    protected $_maxSize = 10;
    protected $_condition = '([1-9]{1}|[0-9]{2,10})';
}