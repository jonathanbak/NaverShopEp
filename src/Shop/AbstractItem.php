<?php
/**
 * 각 상점별 상품 정보 추상화
 * 네이버 EP 컬럼명에 맞게 함수를 추가해주면 매칭되어 들어갑니다.
 * ex) 네이버EP컬럼명 : category_name2 => function getCategory_name2()
 * Author: jonathanbak
 */
namespace NaverShopEp\Shop;

abstract class AbstractItem
{
    protected $data = array();

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * 상품코드
     * @return string
     */
    abstract public function getId();

    /**
     * 상품명
     * @return string
     */
    abstract public function getTitle();

    /**
     * 상품가격
     * @return int
     */
    abstract public function getPrice_pc();

    /**
     * 상품 URL
     * @return string
     */
    abstract public function getLink();

    /**
     * 모바일 상품 URL
     * @return string
     */
    abstract public function getMobile_link();

    /**
     * 이미지 URL
     * @return string
     */
    abstract public function getImage_link();

    /**
     * 제휴사 카테고리명(대분류)
     * @return string
     */
    abstract public function getCategory_name1();

    /**
     * 배송료
     * @return int
     */
    abstract public function getShipping();

}
