<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 기본적으로네이버쇼핑에서는성인용품등은취급불가상품이나,일부취급가능한상품중쇼핑몰내에미성년자구매불가표기가되어있는(성인인증로그인이필요한)상품은‘Y’로표기합니다.
■미성년자 구매 불가 상품의 예
• 성인상품(언더웨어,의류(코스프레),윤활제등)
• 청소년이용불가게임류(게임물관리위원회)
• 청소년유해물건(부탄가스,레이저포인터등)(여성가족부) • 그외제휴사에서성인인증대상에속하는상품
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Adult extends TypeAbstract
{
    protected $_maxsize = 1;
    protected $_condition = 'Y';
}