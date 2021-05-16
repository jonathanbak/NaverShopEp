<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 병행수입상품인경우‘Y로표기하여,해당사항이없는경우에는표기하지않습니다.
• 병행수입상품이란병행수입하여판매되는상품으로국내에서정식발매되는상품보다저렴하나국내A/S지원이어려운상품을의미합니다.
• 병행수입상품이나글로벌워런티적용되어국내A/S가되는상품은상품상세설명등을활용하셔서안내하시기바랍니다.
• 병행수입상품임에도해당값으로전달되지않는경우상품삭제되며복구하여드리지않으며,상품이삭제되는경우클린프로그램적용되어등급이하락할수있으므로주의부탁드리겠습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Parallel_import extends TypeAbstract
{
    protected $_maxsize = 1;
    protected $_condition = 'Y';
}