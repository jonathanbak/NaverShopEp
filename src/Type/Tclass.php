<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * User: sangwonbak
 * Date: 2017. 11. 20.
• I,U,D중상품의상태에맞춰입력(반드시영문대문자여야함)
• 신규상품:I
• 기존상품중업데이트된상품:U
• 품절되었다가다시서비스되는상품:U
• 품절상품:D
• 규칙을 준수하지 않거나 컬럼값이 null일 경우 해당상품 에러 처리함
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Tclass extends TypeAbstract
{
    protected $_required = true;
    protected $_maxSize = 1;
    protected $_condition = '(I|U|D){1}';
}