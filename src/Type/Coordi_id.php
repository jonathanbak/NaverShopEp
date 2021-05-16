<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 코디상품의경우메인(코디)상품에서브상품ID복수개를입력합니다.
• 복수개입력시구분자는‘|’입니다.
• 입력된ID는관계가설정되어향후네이버서비스에서코디상품으로노출됩니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Coordi_id extends TypeAbstract
{
    protected $_maxsize = 500;
    protected $_condition = '([0-9a-zA-Z]+\|?){1,30}';
}