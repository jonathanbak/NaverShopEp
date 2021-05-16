<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 원화기준(면세점제외,면세점은cent단위로입력)으로입력하셔야합니다.
• 숫자를제외한모든항목표시는금지됩니다.숫자가아닌경우에는무효상품처리됩니다.
• 0원은인정하지않으며,1원이상전송하셔야합니다.
• 쿠폰이있을경우,쿠폰적용가로표기합니다.단,쿠폰은모든사용자에게적용가능한쿠폰(특정사용자만가능한쿠폰은제외)이어야합니다.
• 휴대폰및요금제태블릿등의상품의경우,고객이실제구매가능한금액인 ‘고객부담단말기대금(할부원금)’으로전송하여야합니다.
• 반드시노출된가격에추가금없이실제구매가가능하여야합니다.
• 상품가격이상품명/이미지등에서기대한상품과관련이적은필수구매옵션의가격인경우가격어뷰징으로노출중단/삭제처리되오니주의부탁드리겠습니다.
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Price_pc extends TypeAbstract
{
    protected $_required = true;
    protected $_maxSize = 10;
    protected $_condition = '([1-9]{1}|[0-9]{2,10})';
}