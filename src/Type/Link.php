<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 경로는 http://, https://로 시작하여야 하며, Link내에 웹 페이지 주소가 포함되어 있는 경우 해당 주소는 반드시 encoding처리 되어 있어야 합니다. • 한글이 포함된 경우 한글부분은 encoding 되어야 합니다.
• 해당 url로 이동 시 napm parameter의 처리에 문제가 없어야 합니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Link extends TypeAbstract
{
    protected $_required = true;
    protected $_maxsize = 255;
    protected $_condition = '(https?:\/\/[a-zA-Z.0-9&%=#\?\/-_]+)';
}