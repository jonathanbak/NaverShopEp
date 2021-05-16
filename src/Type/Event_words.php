<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 탭/엔터문자및프로그래밍언어의사용은금지됩니다.
• 상품관련기획전/이벤트정보에한해표기합니다.
• 추가로노출여부는‘쇼핑파트너존’을통하여별도요청하여야합니다.
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Event_words extends TypeAbstract
{
    protected $_maxSize = 100;
    protected $_conditionExcept = '[\t\n]+';    //탭, 엔터문자 사용금지
}