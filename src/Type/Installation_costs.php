<?php
/**
 * 네이버쇼핑 EP 3.0 Type 정의
 * Author: jonathanbak
 *
• 일반적으로설치가필요한상품에대해,설치비가추가로발생할경우 ‘Y’로표기(상품정보제공고시>계절가전(에어컨/온풍기)>추가설치비용항목등) • 설치비가이미가격에포함되어있거나,추가설치비가필요하지않은상품일경우컬럼을비워둠.
• 기본설치비가추가로부과되는상품이나해당컬럼을‘Y’로전송하지않는경우상품삭제처리될수있으니주의요망
 */
namespace NaverShopEp\Type;
use NaverShopEp\Type as TypeAbstract;

class Installation_costs extends TypeAbstract
{
    protected $_maxsize = 1;
    protected $_condition = 'Y';
}