<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• link컬럼과동일하며,모바일페이지가없는경우에는표기하지않으셔도됩니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Mobile_link extends TypeAbstract
{
    protected $_maxsize = 255;
    protected $_condition = '(https?:\/\/[a-zA-Z.0-9&%=#\?\/-_]+)';
}