<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 이미지 사이즈는 최소 300*300 pixels 이상(권장 500 * 500pixels 이상)이어야 하며, 최대 4000*4000 pixels 이하까지 처리 됩니다.
• 경로는 http://로 시작되어야 하며, 이미지 타입은 JPEG를 권장합니다.
• 이미지는여백최소화및이미지가중앙에정렬되어있어야합니다.
• image_link 값에 별도의 주소가 포함되어 있는 경우, 해당 주소는 encoding 되어야 합니다.(한글이 포함된 경우 한글부분은 encoding 되어야 합니다.) • 이미지다운로드요청시1초이내response되어야합니다.
• 그리고이미지는상품의특징을잘나타내는이미지여야하며,로고나텍스트만으로구성된이미지는허용하지않습니다.
• 그리고다수상품에동일한이미지를사용하는경우에도마찬가지로EP검수불가처리됩니다.
• 또한주목효과를위해상품과관련없는외곽라인,도형삽입,인위적인마크,텍스트등이포함되어있는이미지의경우발견시상품삭제처리되오니주의부탁드리겠습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Image_link extends TypeAbstract
{
    protected $_required = true;
    protected $_maxsize = 255;
    protected $_condition = '(http:\/\/[a-zA-Z.0-9&%=#\?\/-_]+)';
}