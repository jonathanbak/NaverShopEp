<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 지역이나품목에따라배송비가추가로발생할경우해당상세내용기입
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Delivery_detail extends TypeAbstract
{
    protected $_maxsize = 100;
    protected $_conditionExcept = '[\t\n]+';    //탭, 엔터문자 사용금지
}