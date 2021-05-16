<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 해당하는상품인경우각각‘도매’,‘렌탈’,‘대여’,‘할부’,‘예약판매’,‘구매대행’으로표기하며,해당사항이없는경우에는표기하지않습니다.
• ‘구매대행’이란해외구매대행이아니라 ‘이케아’,‘코스트코’등의오프라인마켓에서구매를대행하여배송하는상품을의미합니다.(해외구매대행상품은해외구매대행여부컬럼에표기해주세요.)
• 상품이위에해당하는상품이나적절하게표기되지않는경우삭제후복구되지않으며,상품이삭제되는경우클린프로그램적용되어등급이하락할수있으므로주의부탁드리겠습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Product_flag extends TypeAbstract
{
    protected $_maxsize = 10;
    protected $_condition = '(도매|렌탈|대여|할부|예약판매|구매대행)';
}