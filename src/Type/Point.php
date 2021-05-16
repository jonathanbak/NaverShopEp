<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 출처^포인트액수로표기하며여러포인트를제공하는경우‘|’로분리하여입력합니다. • 출처가포인트명이없는경우^포인트액수로만표기합니다.(0은표기하지않음)
• 포인트는원화기준으로표기합니다.
 * 쇼핑몰자체포인트^400|OK캐쉬백^300
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Point extends TypeAbstract
{
    protected $_maxsize = 50;
    protected $_condition = '([\xA1-\xFE\xA1-\xFEa-zA-Z0-9]+[^][0-1]+\|?){1,5}';
}