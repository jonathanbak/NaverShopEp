<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 주문제작상품인경우‘Y로표기하여,해당사항이없는경우에는표기하지않습니다.
• 주문제작상품이란판매당시제작이진행되어있지않아서소비자에서배송되기까지일정시일이소요되는상품을의미합니다.
• 수공예물품,주문제작가구등이이에해당하며인쇄물,판촉물등은이에해당하지않습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Order_made extends TypeAbstract
{
    protected $_maxsize = 1;
    protected $_condition = 'Y';
}