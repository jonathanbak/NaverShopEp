<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 네이버쇼핑에노출되는상품가격(=제휴할인가)이쇼핑몰상품페이지에표시된가격과다르고,팝업화면등에서별도의쿠폰을다운로드받아야해당가격으로구매할수있을경우Y표기
• 가격이같고쿠폰다운로드할필요가없을경우에는값을표기하지않음
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Partner_coupon_download extends TypeAbstract
{
    protected $_maxsize = 1;
    protected $_condition = 'Y';
}