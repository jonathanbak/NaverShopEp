<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
• 탭/엔터문자및프로그래밍언어의사용은금지됩니다.
• 일반쿠폰과제휴쿠폰의구분은‘^’꺽쇠(caret)기호로구분하여입력합니다.
• 1개상품에대해할인율이가장높은각1개의쿠폰만표기가능합니다.
• 일반쿠폰: 할인금액표기:원단위까지표기(콤마제외),할인율표기:%단위까지표기
• 제휴쿠폰: 할인율표기:숫자(정수)만표기되어야함(0<제휴쿠폰<100), 소수점한자리까지표기가능 • 예시
- 일반쿠폰만 있는 경우 : 1000원, 10%
- 일반/제휴쿠폰 둘 다 있는 경우 : 1000원^5, 10%^5 -제휴쿠폰만있는경우:^5
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Coupon extends TypeAbstract
{
    protected $_maxSize = 100;
    protected $_condition = '([0-9]+원|%)?(\^[0-9]{1,2})?';
    protected $_conditionExcept = '[\t\n]+';    //탭, 엔터문자 사용금지
}