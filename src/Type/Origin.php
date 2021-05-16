<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 탭/엔터문자등은사용불가합니다.
• 프로그래밍언어의사용은금지됩니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Origin extends TypeAbstract
{
    protected $_maxSize = 30;
    protected $_conditionExcept = '[\t\n]+';    //탭, 엔터문자 사용금지
}