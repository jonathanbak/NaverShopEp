<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 상품의속성정보를^(caret)으로구분하여텍스트를순차적으로입력합니다.
서울^1개^오션뷰^2명^주중^조식포함^무료주차^와이파이
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Attribute extends TypeAbstract
{
    protected $_maxSize = 500;
    protected $_condition = '([^\^]+^?){1,50}';
}