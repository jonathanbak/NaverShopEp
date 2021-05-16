<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * User: sangwonbak
 * Date: 2017. 11. 20.
• 최종조합이완료되어재고및가격까지입력된정보를구매옵션명^가격형태로붙여입력하며, 옵션별‘|’로구분하여입력합니다.
(선택형, 조합형, 텍스트형(독립형, 직접입력형)만 혀용 되며, 계산형은 포함하지 않습니다.)
• 최대50개or1000자이내의정보가처리되나,최종조합구매옵션이50건이넘는경우에는전송하지않으셔도됩니다.
• 구매가능한구매옵션상품에한해서구매옵션정보를전달해주셔야합니다.
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Option_detail extends TypeAbstract
{
    protected $_maxSize = 100;
    protected $_condition = '([^\^]+\^[0-9]+\|?){1,50}';
}