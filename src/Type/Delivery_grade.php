<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 배송비컬럼으전송한무료배송여부또는배송비금액이특정조건에만한정되며,지역이나품목에따라배송비가추가로발생할경우‘Y’로표기 ( 상품정보제공고시 > 가구(침대/소파/싱크대/DIY제품)상품군>배송 설치 비용 항목 등)
• 일반적인도서산간지역에대한추가배송비는해당하지않음.
• 지역이나품목에따라추가배송비가부과되는상품이나,해당컬럼을Y로전송하지않을경우상품이삭제처리될수있으니주의요망
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Delivery_grade extends TypeAbstract
{
    protected $_maxsize = 1;
    protected $_condition = 'Y';
}