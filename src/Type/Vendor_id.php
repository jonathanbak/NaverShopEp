<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 몰명^해당몰의상품ID로입력합니다.
• A몰이B오픈마켓과C오픈마켓에입점한경우B오픈마켓^B오픈마켓상품ID|C오픈마켓^C오픈마켓상품ID의형태로입력합니다.
• B오픈마켓에서A몰이신규입점하였고기존A몰이네이버쇼핑에입점중인경우에도사용할수있는데,이경우B오픈마켓에서는A몰^A몰상품ID로입력후전달합니다. • 입력된값은빠른카테고리매칭등에활용됩니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Vendor_id extends TypeAbstract
{
    protected $_maxsize = 500;
    protected $_condition = '([\xA1-\xFE\xA1-\xFEa-zA-Z0-9]+[^][0-9a-zA-Z]+\|?){1,20}';
    //\x{AC00}-\x{D7AF}
}