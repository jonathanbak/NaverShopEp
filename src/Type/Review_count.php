<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 탭/엔터문자사용금지
• 프로그래밍언어사용금지
• 상품PID에적용된상품평의개수만표기(사용자리뷰,구매후기등의개수)
• 리뷰가없는경우표기하지않거나0으로표기합니다.
• 실제상품페이지보다많은수량으로전달되거나,리뷰신뢰성이떨어진다고판단되는경우에는상품이노출중단될수있으니주의바랍니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Review_count extends TypeAbstract
{
    protected $_maxsize = 10;
    protected $_condition = '([0-9]+)';
}