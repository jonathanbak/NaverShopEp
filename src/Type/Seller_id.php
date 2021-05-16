<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * User: sangwonbak
 * Date: 2017. 11. 20.
• 탭/엔터문자사용금지
• 프로그래밍언어사용금지
• 영문/숫자및한정된특수문자(-_공백)만허용
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Seller_id extends TypeAbstract
{
    protected $_maxSize = 50;
    protected $_condition = '([a-zA-Z0-9-_\s]+)';
    protected $_conditionExcept = '[\t\n]+';    //탭, 엔터문자 사용금지
}