<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 다음4가지상품구분중해당구분명을텍스트로표기합니다. • 2개이상중복일경우,대표1개구분명만표기합니다.
-백화점상품:DP -홈쇼핑상품:HS -면세점상품:DF -마트상품:MA
• 위4가지구분에해당되지않을경우,값을표기하지않습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Goods_type extends TypeAbstract
{
    protected $_maxsize = 10;
    protected $_condition = '(DP|HS|DF|MA)';
}