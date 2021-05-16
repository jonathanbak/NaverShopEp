<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 이스케이프문자등의프로그래밍언어의사용은금지되며쇼핑몰의카테고리명만표기되어야합니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Category_name1 extends TypeAbstract
{
    protected $_required = true;
    protected $_maxsize = 50;
    protected $_condition = '[\xa1-\xfe0-9a-zA-Z\s\/]+';
}