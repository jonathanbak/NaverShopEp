<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 띄어쓰기 없이 ‘|’(Vertical bar)로 구분하여 입력 합니다.
• 10개까지입력가능하며10개가넘는경우10개까지만처리됩니다.또한전체값이100자를넘는경우에는100자를넘는데이터는처리되지않으니주의바랍니다. • 검색태그는상품의검색부가정보로사용되나,검색결과노출을보장하지는않습니다.
• 판매상품과직접관련이없는다른상품명,유명상품유사문구,스팸성키워드입력시관리자에의해노출중단/삭제될수있습니다.
• 그리고입력된정보는바로사용되지않으며,별도클렌징작업을거쳐서반영되기때문에입력한값이모두반영되지않을수있습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Search_tag extends TypeAbstract
{
    protected $_maxsize = 100;
    protected $_condition = '([\xa1-\xfe0-9a-zA-Z\/]+\|?){1,10}';
}