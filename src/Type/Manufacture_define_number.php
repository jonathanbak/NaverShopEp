<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 제조사나브랜드사에서상품을관리하기위해발급한상품관리코드를표기합니다.
• 별도의관리코드가없는경우표기하지않으셔도되나,표기시원활한가격비교서비스가가능합니다.
• 다만제조사나브랜드에서사용하는코드가아닌개별상품관리를위해사용하시는자체코드는표기하지않습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Manufacture_define_number extends TypeAbstract
{
    protected $_maxsize = 100;
    protected $_condition = '[A-Z0-9]+';
}