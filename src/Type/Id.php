<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: Jonathanbak
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Id extends TypeAbstract
{
    protected $_required = true;
    protected $_maxSize = 50;
    protected $_condition = '[a-zA-Z0-9-_\s]+';
}