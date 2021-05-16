<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 네이버카테고리ID(정수8자리)입력하셔야합니다.
• 몰자체의카테고리를입력하거나존재하지않는카테고리ID의입력은허용되지않습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Naver_category extends TypeAbstract
{
    protected $_maxsize = 8;
    protected $_condition = '[0-9]{8}';
}