<?php
/**
 * 네이버샵 전체 EP
 * Author: jonathanbak
 */
namespace NaverShopEp;

use NaverShopEp\Shop\AbstractItem;

class Product
{
    const UPDATE = 'U';
    const INSERT = 'I';
    const DELETE = 'D';

    protected $epObject = null;
    protected $itemObject = null;

    public function setEp(Base $NaverShopProduct)
    {
        $this->epObject = $NaverShopProduct;
    }

    public function setShop(AbstractItem $ShopProduct)
    {
        $this->itemObject = $ShopProduct;
    }

    public function match()
    {
        $NaverShopProduct = $this->epObject;
        $ShopProduct = $this->itemObject;

        $NaverShopProduct->setId($ShopProduct->getId());//상품아이디
        $NaverShopProduct->setTitle($ShopProduct->getTitle());//상품명
        $NaverShopProduct->setPrice_pc($ShopProduct->getPrice_pc());//상품 가격
        if(method_exists($ShopProduct, 'getPrice_mobile'))
            $NaverShopProduct->setPrice_mobile($ShopProduct->getPrice_mobile());//모바일 상품 가격 생략
        if(method_exists($ShopProduct, 'getNormal_price'))
            $NaverShopProduct->setNormal_price($ShopProduct->getNormal_price());//정가
        $NaverShopProduct->setLink($ShopProduct->getLink());//상품 URL
        $NaverShopProduct->setMobile_link($ShopProduct->getMobile_link());//모바일 상품 URL
        $NaverShopProduct->setImage_link($ShopProduct->getImage_link());//이미지 URL
//        $NaverShopProduct->setAdd_image_link( "" );//추가 이미지 URL |로 구분하여 입력
        if(method_exists($ShopProduct, 'getNormal_price'))
            $NaverShopProduct->setCategory_name1($ShopProduct->getCategory_name1());//업체 카테고리명 (대분류)
        if(method_exists($ShopProduct, 'getCategory_name2'))
            $NaverShopProduct->setCategory_name2($ShopProduct->getCategory_name2());//업체 카테고리명 (중분류) (미존재시 공란)
        if(method_exists($ShopProduct, 'getCategory_name3'))
            $NaverShopProduct->setCategory_name3($ShopProduct->getCategory_name3());//업체 카테고리명 (소분류) (미존재시 공란)
        if(method_exists($ShopProduct, 'getCategory_name4'))
            $NaverShopProduct->setCategory_name4($ShopProduct->getCategory_name4());//업체 카테고리명 (세분류) (미존재시 공란)

        if(method_exists($ShopProduct, 'getNaver_category'))
            $NaverShopProduct->setNaver_category($ShopProduct->getNaver_category());//네이버 카테고리

        if(method_exists($ShopProduct, 'getNaver_product_id'))
            $NaverShopProduct->setNaver_product_id($ShopProduct->getNaver_product_id());//가격비교 페이지 ID

        if(method_exists($ShopProduct, 'getCondition'))
            $NaverShopProduct->setCondition($ShopProduct->getCondition());
        else
            $NaverShopProduct->setCondition(Type\Condition::STATUS_NEW);//상품상태

        if(method_exists($ShopProduct, 'getImport_flag'))
            $NaverShopProduct->setImport_flag($ShopProduct->getImport_flag());//해외구매대행 여부
        if(method_exists($ShopProduct, 'getParallel_import'))
            $NaverShopProduct->setParallel_import($ShopProduct->getParallel_import());//병행수입 여부
        if(method_exists($ShopProduct, 'getOrder_made'))
            $NaverShopProduct->setOrder_made($ShopProduct->getOrder_made());//주문제작상품 여부
        if(method_exists($ShopProduct, 'getProduct_flag'))
            $NaverShopProduct->setProduct_flag($ShopProduct->getProduct_flag());//판매방식 구분
        if(method_exists($ShopProduct, 'getAdult'))
            $NaverShopProduct->setAdult($ShopProduct->getAdult());//미성년자 구매불가 상품 여부

        if(method_exists($ShopProduct, 'getGoods_type'))
            $NaverShopProduct->setGoods_type($ShopProduct->getGoods_type());//상품 구분

        if(method_exists($ShopProduct, 'getBarcode'))
            $NaverShopProduct->setBarcode($ShopProduct->getBarcode());//바코드
        if(method_exists($ShopProduct, 'getManufacture_define_number'))
            $NaverShopProduct->setManufacture_define_number($ShopProduct->getManufacture_define_number());//제품코드
        if(method_exists($ShopProduct, 'getModel_number'))
            $NaverShopProduct->setModel_number($ShopProduct->getModel_number());//모델명
        if(method_exists($ShopProduct, 'getBrand'))
            $NaverShopProduct->setBrand($ShopProduct->getBrand());//브랜드 =>출판사
        if(method_exists($ShopProduct, 'getMaker'))
            $NaverShopProduct->setMaker($ShopProduct->getMaker());//제조사
        if(method_exists($ShopProduct, 'getOrigin'))
            $NaverShopProduct->setOrigin($ShopProduct->getOrigin());//원산지
        if(method_exists($ShopProduct, 'getCard_event'))
            $NaverShopProduct->setCard_event($ShopProduct->getCard_event());//카드명/카드할인가격
        if(method_exists($ShopProduct, 'getEvent_words'))
            $NaverShopProduct->setEvent_words($ShopProduct->getEvent_words());//카드명/카드할인가격
        if(method_exists($ShopProduct, 'getCoupon'))
            $NaverShopProduct->setCoupon($ShopProduct->getCoupon());//일반/제휴쿠폰
        if(method_exists($ShopProduct, 'getPartner_coupon_download'))
            $NaverShopProduct->setPartner_coupon_download($ShopProduct->getPartner_coupon_download());//쿠폰다운로드필요 여부
        if(method_exists($ShopProduct, 'getInterest_free_event'))
            $NaverShopProduct->setInterest_free_event($ShopProduct->getInterest_free_event());//카드무이자할부정보
        if(method_exists($ShopProduct, 'getPoint'))
            $NaverShopProduct->setPoint($ShopProduct->getPoint());//포인트, 적립금
        if(method_exists($ShopProduct, 'getInstallation_costs'))
            $NaverShopProduct->setInstallation_costs($ShopProduct->getInstallation_costs());//별도 설치비 유무

        if(method_exists($ShopProduct, 'getSearch_tag'))
            $NaverShopProduct->setSearch_tag($ShopProduct->getSearch_tag());//검색태그
        if(method_exists($ShopProduct, 'getGroup_id'))
            $NaverShopProduct->setGroup_id($ShopProduct->getGroup_id());//Group ID
        if(method_exists($ShopProduct, 'getVendor_id'))
            $NaverShopProduct->setVendor_id($ShopProduct->getVendor_id());//제휴사 상품 ID
        if(method_exists($ShopProduct, 'getCoordi_id'))
            $NaverShopProduct->setCoordi_id($ShopProduct->getCoordi_id());//코디상품ID
        if(method_exists($ShopProduct, 'getMinimum_purchase_quantity'))
            $NaverShopProduct->setMinimum_purchase_quantity($ShopProduct->getMinimum_purchase_quantity());//최소구매수량
        if(method_exists($ShopProduct, 'getReview_count'))
            $NaverShopProduct->setReview_count($ShopProduct->getReview_count());//상품평(리뷰,구매평) 개수
        if(method_exists($ShopProduct, 'getShipping'))
            $NaverShopProduct->setShipping($ShopProduct->getShipping());//배송료
        if(method_exists($ShopProduct, 'getDelivery_grade'))
            $NaverShopProduct->setDelivery_grade($ShopProduct->getDelivery_grade());//차등배송비 여부
        if(method_exists($ShopProduct, 'getDelivery_detail'))
            $NaverShopProduct->setDelivery_detail($ShopProduct->getDelivery_detail());//차등배송비 내용

        if(method_exists($ShopProduct, 'getAttribute'))
            $NaverShopProduct->setAttribute($ShopProduct->getAttribute());//상품속성
        if(method_exists($ShopProduct, 'getOption_detail'))
            $NaverShopProduct->setOption_detail($ShopProduct->getOption_detail());//구매옵션
        if(method_exists($ShopProduct, 'getSeller_id'))
            $NaverShopProduct->setSeller_id($ShopProduct->getSeller_id());//셀러 ID (오프마켓에 한함)
        if(method_exists($ShopProduct, 'getAge_group'))
            $NaverShopProduct->setAge_group($ShopProduct->getAge_group());//주이용고객층
        if(method_exists($ShopProduct, 'getGender'))
            $NaverShopProduct->setGender($ShopProduct->getGender());//성별

        $this->epObject = $NaverShopProduct;
        $this->itemObject = $ShopProduct;
    }

    public function update($createDateTime)
    {
        $this->epObject->setTClass(self::UPDATE);//I (신규상품)/U(업데이트상품)/D(품절상품)
        $this->epObject->setUpdate_time($createDateTime);//상품정보 생성 시각
    }

    public function insert($createDateTime)
    {
        $this->epObject->setTClass(self::INSERT);//I (신규상품)/U(업데이트상품)/D(품절상품)
        $this->epObject->setUpdate_time($createDateTime);//상품정보 생성 시각
    }
    public function delete($createDateTime)
    {
        $this->epObject->setTClass(self::DELETE);//I (신규상품)/U(업데이트상품)/D(품절상품)
        $this->epObject->setUpdate_time($createDateTime);//상품정보 생성 시각
    }

    public function get()
    {
        return $this->epObject;
    }

}
