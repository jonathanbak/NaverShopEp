<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 이스케이프문자등의프로그래밍언어의사용은금지되며쇼핑몰의카테고리명만표기되어야합니다.
• 소분류가 없는 경우에는 해당 컬럼은 null(공란)처리 되어야 합니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Category_name3 extends TypeAbstract
{
    protected $_maxsize = 50;
    protected $_condition = '[\xa1-\xfe0-9a-zA-Z\s\/]+';
}