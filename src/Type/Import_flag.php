<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 기존 prefix정책([해외])은 사용하지 않으며, 해외 구매대행 상품인 경우 ‘Y’로 표기 합니다.
• 해외구매대행상품임에도적절하게표기되어있지않은상품들은노출중지/상품삭제되며복구하여드리지않으며,상품이삭제되는경우클린프로그램적용되어등급이하락할수있으므로주의부탁
드리겠습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Import_flag extends TypeAbstract
{
    protected $_maxsize = 1;
    protected $_condition = 'Y';
}