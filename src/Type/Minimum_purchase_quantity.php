<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 최소구매수량이설정되어있는경우최소구매수량을입력합니다.
• 가격관련컬럼들은실제구매가능한가격으로전송해주셔야합니다.(단위가격*최소구매수량)
• 최소구매수량이설정되어있는상품임에도해당컬럼에값이없는경우상품삭제/복구불가처리됩니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Minimum_purchase_quantity extends TypeAbstract
{
    protected $_maxsize = 10;
    protected $_condition = '([0-9]+)';
}