<?php
/**
 * 네이버샵 부분 EP
 * Author: jonathanbak
 */
namespace NaverShopEp\Ep;

use NaverShopEp\Base;

class Simple extends Base
{
    protected $id = null;    //상품 ID
    protected $title = null;    //상품명
    protected $price_pc = null;    //상품가격
    protected $price_mobile = null;    //모바일 전용 상품가격
    protected $normal_price = null;    //정가
    protected $link = null;    //상품 URL
    protected $mobile_link = null;    //모바일 상품 URL
    protected $image_link = null;    //이미지 URL
    protected $add_image_link = null;    //추가 이미지
    protected $category_name1 = null;    //업체 카테고리명 (대분류)
    protected $category_name2 = null;    //업체 카테고리명 (중분류)
    protected $category_name3 = null;    //업체 카테고리명 (소분류)
    protected $category_name4 = null;    //업체 카테고리명 (세분류)
    protected $naver_category = null;    //네이버 카테고리
    protected $naver_product_id = null;    //가격비교 페이지 ID
    protected $condition = null;    //상품상태
    protected $import_flag = null;    //해외구매대행 여부
    protected $parallel_import = null;    //병행 수입 여부
    protected $order_made = null;    //주문제작 상품 여부
    protected $product_flag = null;    //판매방식 구분
    protected $adult = null;    //미성년자 구매불가 상품여부
    protected $goods_type = null;    //상품 구분
    protected $barcode = null;    //바코드
    protected $manufacture_define_number = null;    //제품코드
    protected $model_number = null;    //모델명
    protected $brand = null;    //브랜드
    protected $maker = null;    //제조사
    protected $origin = null;    //원산지
    protected $card_event = null;    //카드명/카드할인가격
    protected $event_words = null;    //이벤트
    protected $coupon = null;    //일반/제휴쿠폰
    protected $partner_coupon_download = null;    //쿠폰 다운로드필요 여부
    protected $interest_free_event = null;    //카드무이자할부정보
    protected $point = null;    //포인트
    protected $installation_costs = null;    //별도 설치비 유무

    protected $search_tag = null;    //검색태그
    protected $group_id = null;    //Group ID
    protected $vendor_id = null;    //제휴사 상품 ID
    protected $coordi_id = null;    //코디상품ID
    protected $minimum_purchase_quantity = null;    //최소구매수량

    protected $review_count = null;    //상품평(리뷰구매평)개수
    protected $shipping = null;    //배송료
    protected $delivery_grade = null;    //차등배송비 여부
    protected $delivery_detail = null;    //차등배송비 내용

    protected $attribute = null;    //상품속성
    protected $option_detail = null;    //구매옵션
    protected $seller_id = null;    //셀러 ID (오픈마켓에 한함)
    protected $age_group = null;    //주이용고객층
    protected $gender = null;    //성별

    protected $tclass = null;    //I 신규상품, U(업데이트상품), D(품절상품)
    protected $update_time = null;    //상품정보 생성 시각

}
