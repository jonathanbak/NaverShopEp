<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 * • 띄어쓰기없이표기하며,‘카드명^카드할인가’로구분하여입력.여러카드행사를동시진행시‘|’기호로구분하여입력 • 할인율이가장큰카드를먼저입력합니다.
 * ■카드명
 * • 카드명은아래리스트에포함되어있는카드를‘정확한카드명’으로전송하여야정상처리됩니다.(e.g.현대카드,삼성카드,BC카드,VISA카드등)
 * • 카드사&카드사조합은불가능합니다.(e.g.우리BC,롯데아멕스등)
 * • BC,VISA같이다른카드와연계된카드의경우제휴된카드전체에서사용가능할경우만포함되어야합니다.(전달시‘BC카드’,‘VISA카드’로전달)
 * • 특수/쇼핑몰제휴카드처리불가합니다.(e.g.문화융성카드,문화누리카드등)
 * • 특정멤버십카드, 온라인결제수단은사용불가합니다.(백화점,통신사등멤버십용도(e.g.삼성T카드,갤러리아카드),온라인결제수단(e.g.PAYCO)) • 카드는전월실적관계없이할인혜택가능하여야합니다.
 * ■카드할인가
 * • price_pc 컬럼과 동일한 포맷
 * • 프로모션진행중인카드를기준으로카드할인이적용된금액으로표시 • 원화기준(면세점제외,면세점은cent단위로입력)
 * • 숫자를제외한모든항목표시금지
 * • 단품판매가가카드할인금액보다낮은경우제외
 */

namespace NaverShopEp\Type;

use NaverShopEp\Type as TypeAbstract;

class Card_event extends TypeAbstract
{
    protected $_maxSize = 100;
    protected $_condition = '((현대카드|삼성카드|롯데카드|KB국민카드|KEB하나카드|우리카드|씨티카드|신한카드|SC제일카드|대구카드|부산카드|광주카드|경남카드|전북카드|제주카드|NH농협카드|IBK기업은행카드|수협카드|KDB산업카드|신협카드|우체국카드|새마을금고카드|산림조합카드|저축은행카드|BC카드|VISA카드|MASTERCARD카드|AMEX카드|JCB카드|Unionpay카드)\^[0-9]+\|?){1,10}';
}