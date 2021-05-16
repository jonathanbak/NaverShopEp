<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 탭/엔터문자및프로그래밍언어사용은금지됩니다.
• 무이자행사카드명^무이자할부개월수로 입력하며,여러카드사의행사를동시진행하는경우‘|’기호로분리하여입력합니다. • 카드사명은할인카드명을따르며무이자할부행사는제품단가기준으로제공이가능한무이자행사여야합니다.
 * 삼성카드^2~3|신한카드^2~3|현대카드^2~3
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Interest_free_event extends TypeAbstract
{
    protected $_maxsize = 100;
    protected $_condition = '([\xa1-\xfe0-9a-zA-Z\s]+\^[0-1]~[0-1]{1,2}\|?){1,10}';
    protected $_conditionExcept = '[\t\n]+';    //탭, 엔터문자 사용금지
}