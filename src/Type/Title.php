<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Title extends TypeAbstract
{
    protected $_required = true;
    protected $_maxSize = 100;
    protected $_conditionExcept = '[\t\n]+';    //탭, 엔터문자 사용금지
}