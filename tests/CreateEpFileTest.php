<?php

namespace NaverShopEpTest;

use NaverShopEp\Ep\Full;
use NaverShopEp\Ep\Simple;
use NaverShopEp\Exception;
use NaverShopEp\ItemManage;
use NaverShopEp\MakeHandler;
use NaverShopEp\Product;
use NaverShopEp\Shop\AbstractItem;
use NaverShopEp\Shop\AbstractLists;

/**
 * Class ShopLists
 * 각 쇼핑몰에 맞게 NaverShopEp\Shop\AbstractLists 확장하여 쿼리 넣어주시면 됩니다.
 */
class ShopLists extends AbstractLists {

    /**
     * 주문판매상태 고려 전송하고자 하는 상품 선택 쿼리
     * 전송되는 정보 고려 (변경시 업데이트 필요) item_hash 작성
     * @return string
     */
    public function queryAll()
    {
        $query = "SELECT s_idx as uid, s_goods_name, s_img_url, s_price, IF(s_stock>0,1,0) as is_stock, s_status, s_last_update,
                        md5(CONCAT(s_goods_name, s_img_url, s_price, s_status, IF(s_stock>0,1,0))) as item_hash
                FROM shop_item WHERE s_status = 1 AND s_nshop_flag = 'Y' ORDER BY s_idx ASC LIMIT 10
                ";
        return $query;
    }
}

/**
 * Class ShopLists
 * 각 쇼핑몰에 맞게 NaverShopEp\Shop\AbstractItem 확장하여 데이터 맞춰주시면 됩니다.
 */
class ShopItem extends AbstractItem {

    public function getId()
    {
        return $this->data['uid'];
    }

    public function getCategory_name1()
    {
        return '카테고리1';
    }

    public function getImage_link()
    {
        return 'http://sample.com'.$this->data['s_img_url'];
    }

    public function getLink()
    {
        return 'http://sample.com/goods/detail?gno='.$this->data['uid'];
    }

    public function getMobile_link()
    {
        return 'http://sample.com/goods/detail?gno='.$this->data['uid'];
    }

    public function getPrice_pc()
    {
        return $this->data['s_price'];
    }

    public function getShipping()
    {
        return 0;
    }

    public function getTitle()
    {
        return $this->data['s_goods_name'];
    }
}

/**
 * Shop\Item
 */
class CreateEpFileTest extends \PHPUnit\Framework\TestCase
{
    const EP_DIR = 'tests/_ep';
    static $dbConn = null;

    public static function setUpBeforeClass() : void
    {
        list($host, $user, $password, $dbName, $dbPort) = array($GLOBALS['DB_HOST'],$GLOBALS['DB_USER'],$GLOBALS['DB_PASSWD'],$GLOBALS['DB_NAME'], isset($GLOBALS['DB_PORT'])? $GLOBALS['DB_PORT'] : '3306');
        //1. DB 연결
        self::$dbConn = new \mysqli($host, $user, $password, $dbName, $dbPort);

        if(self::$dbConn->connect_errno){
            echo '[연결실패] : '.self::$dbConn->connect_error.'';
        } else {
            //echo '[연결성공]';
        }

    }

    public function testCreateFullEp()
    {
        $MakeHandler = new MakeHandler();
        $MakeHandler->setEpDir(CreateEpFileTest::EP_DIR);
        $MakeHandler->createFileStart();
        $ShopLists = new ShopLists();
        $ItemManager = new ItemManage();
        $query = $ItemManager->getAllQuery($ShopLists);
        //1. 쿼리 실행
        $result = self::$dbConn->query($query) or die(self::$dbConn->error);

        $ProductProxy = new Product();
        //전체 목록 체크하여 데이터 생성
        while($data = $result->fetch_array()) {
            try {
                $NaverShopEpProduct = new Full();  //EP 풀버전
                $ProductProxy->setEp($NaverShopEpProduct);
                $ShopItem = new ShopItem($data);
                $ProductProxy->setShop($ShopItem);
                $ProductProxy->match();
                $MakeHandler->createFileContent($ProductProxy->get());

                $registEpItemData = ['ne_uid'=>$data['uid'], 'ne_item_hash'=>$data['item_hash']];
                $addQuery = $ItemManager->add($registEpItemData);
                self::$dbConn->query($addQuery);
                //쿼리 실행
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
        $fileContent = $MakeHandler->readFile();

        $this->assertTrue(strlen($fileContent)>0);
    }

    public function testUpdateProduct()
    {
        //수정
        $query = "UPDATE shop_item SET s_img_url = '/image/goods/3_1.jpg', s_last_update = now() WHERE s_idx = 3";
        self::$dbConn->query($query);

        //재고 품절
        $query = "UPDATE shop_item SET s_stock = 0, s_last_update = now() WHERE s_idx = 4";
        self::$dbConn->query($query);

        //추가
        $query = "INSERT INTO shop_item (s_idx, s_goods_name, s_img_url, s_price, s_stock, s_status, s_nshop_flag, s_last_update)
                    values
                    ('7','상품7','/image/goods/7.jpg','11000','20','1','Y',now()),
                    ('8','상품8','/image/goods/8.jpg','12300','10','1','Y',now()),
                    ('9','상품9','/image/goods/9.jpg','1100','30','1','Y',now())";
        self::$dbConn->query($query);

        $this->assertTrue(true);
    }

    /**
     * @depends testUpdateProduct
     * @throws Exception
     */
    public function testCreateSimpleEp()
    {
        $MakeHandler = new MakeHandler(MakeHandler::TYPE_SIMPLE);
        $MakeHandler->setEpDir(CreateEpFileTest::EP_DIR);
        $MakeHandler->createFileStart();
        $ShopLists = new ShopLists();
        $ItemManager = new ItemManage();
        //1. 변경된 상품 불러오기
        $query = $ItemManager->getChangeListQuery($ShopLists);
        $result = self::$dbConn->query($query) or die(self::$dbConn->error);
        $ProductProxy = new Product();
        $createDateTime = date("Y-m-d H:i:s");  //상품정보 생성 시각
        while($data = $result->fetch_array()) {
            try {
                $NaverShopEpProduct = new Simple();  //EP 요약버전
                $ProductProxy->setEp($NaverShopEpProduct);
                if ($data['is_stock'] == 0) {
                    //품절된 상품 삭제
                    $ShopItem = new ShopItem($data);
                    $ProductProxy->setShop($ShopItem);
                    $ProductProxy->delete($createDateTime);//상품정보 생성 시각
                    $ProductProxy->match();
                    echo $ProductProxy->get();
                    $MakeHandler->createFileContent($ProductProxy->get());

                    $registEpItemData = ['ne_uid'=>$data['uid'], 'ne_item_hash'=>$data['item_hash']];
                    $addQuery = $ItemManager->add($registEpItemData);
                    self::$dbConn->query($addQuery);
                } else {
                    //변경된 상품 업데이트
                    $ShopItem = new ShopItem($data);
                    $ProductProxy->setShop($ShopItem);
                    $ProductProxy->update($createDateTime);//상품정보 생성 시각
                    $ProductProxy->match();
                    echo $ProductProxy->get();
                    $MakeHandler->createFileContent($ProductProxy->get());

                    $registEpItemData = ['ne_uid'=>$data['uid'], 'ne_item_hash'=>$data['item_hash']];
                    $addQuery = $ItemManager->add($registEpItemData);
                    self::$dbConn->query($addQuery);
                }
                //쿼리 실행
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }

        //2. 추가된 상품 불러오기
        $query = $ItemManager->getNewListQuery($ShopLists);
        $result = self::$dbConn->query($query) or die(self::$dbConn->error);
        while($data = $result->fetch_array()) {
            try {
                $NaverShopEpProduct = new Simple();  //EP 요약버전
                $ProductProxy->setEp($NaverShopEpProduct);
                //변경된 상품 업데이트
                $ShopItem = new ShopItem($data);
                $ProductProxy->setShop($ShopItem);
                $ProductProxy->insert($createDateTime);//상품정보 생성 시각
                $ProductProxy->match();
                echo $ProductProxy->get();
                $MakeHandler->createFileContent($ProductProxy->get());

                $registEpItemData = ['ne_uid'=>$data['uid'], 'ne_item_hash'=>$data['item_hash']];
                $addQuery = $ItemManager->add($registEpItemData);
                self::$dbConn->query($addQuery);

                //쿼리 실행
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }

        $fileContent = $MakeHandler->readFile();

        $this->assertTrue(strlen($fileContent)>0);
    }

    /**
     * 테스트후 데이터 이전상태로
     */
    public static function tearDownAfterClass(): void
    {
        //수정 복구
        $query = "UPDATE shop_item SET s_img_url = '/image/goods/3.jpg', s_last_update = '2021-05-15 05:55:00' WHERE s_idx = 3";
        self::$dbConn->query($query);
        $query = "UPDATE nshop_epitem SET ne_item_hash = (SELECT md5(CONCAT(s_goods_name, s_img_url, s_price, s_status, IF(s_stock>0,1,0))) FROM shop_item WHERE s_idx = 3) WHERE ne_uid = 3";
        self::$dbConn->query($query);

        //재고 품절 복구
        $query = "UPDATE shop_item SET s_stock = 10 WHERE s_idx = 4";
        self::$dbConn->query($query);
        $query = "UPDATE nshop_epitem SET ne_item_hash = (SELECT md5(CONCAT(s_goods_name, s_img_url, s_price, s_status, IF(s_stock>0,1,0))) FROM shop_item WHERE s_idx = 4) WHERE ne_uid = 4";
        self::$dbConn->query($query);

        //추가 삭제
        $query = "DELETE FROM shop_item WHERE s_idx IN (7,8,9)";
        self::$dbConn->query($query);

        $query = "DELETE FROM nshop_epitem WHERE ne_uid IN (7,8,9)";
        self::$dbConn->query($query);

    }
}