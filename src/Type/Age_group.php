<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• ‘유아’,‘아동’,‘청소년’,‘성인’이외의값은처리되지않으며,값이없는경우에는‘성인’으로처리됩니다.
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Age_group extends TypeAbstract
{
    protected $_maxSize = 10;
    protected $_condition = '(유아|아동|청소년|성인)';
}