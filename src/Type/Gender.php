<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 상품의주요구매고객의성별을텍스트로입력합니다.‘남성’,’여성’,’남녀공용’값만허용되며,사용자성별을정할필요가없는상품(가전제품등)에는표기하지않습니다.
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Gender extends TypeAbstract
{
    protected $_maxSize = 10;
    protected $_condition = '(남성|여성|남녀공용)';
}