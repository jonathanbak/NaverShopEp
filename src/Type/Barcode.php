<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 표준형상품식별코드(GTIN-13)나단축형바코드(GTIN-8)만입력
• 바코드숫자이외다른문자의사용은금지됩니다.
• 표기시원활한가격비교서비스가가능합니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Barcode extends TypeAbstract
{
    protected $_maxsize = 13;
    protected $_condition = '([987]{3}[0-9]{10})';
}