<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 이미지 URL과 동일한 기준이 적용되며, ‘|(Vertical bar)’ 기호로 분리하여 최대 10개까지 입력이 가능합니다.
• 추가이미지는대표이미지보다썸네일이미지가천천히생성될수있습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Add_image_link extends TypeAbstract
{
    protected $_maxsize = 2560;
    protected $_condition = '(http:\/\/[a-zA-Z.0-9&%=#\?\/-_]+\|?){1,10}';
}