<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * User: sangwonbak
 * Date: 2017. 11. 20.
• ‘yyyy-mm-ddhh:mm:ss’형식이어야함
• 상품정보생성당시서버시각으로표기
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Update_time extends TypeAbstract
{
    protected $_required = true;
    protected $_maxSize = 19;
    protected $_condition = '([0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2})';
}