<?php
define('__SITE_ROOT__', dirname(__DIR__));
require __SITE_ROOT__ . "/vendor/autoload.php";

include_once("./db.inc.php");
include_once("./shop.class.php");

use NaverShopEp\Ep\Simple;
use NaverShopEp\Exception;
use NaverShopEp\ItemManage;
use NaverShopEp\MakeHandler;
use NaverShopEp\Product;

global $host, $user, $password, $dbName, $dbPort;

//db커넥
$dbConn = new \mysqli($host, $user, $password, $dbName, $dbPort);

if($dbConn->connect_errno){
    echo '[연결실패] : '.$dbConn->connect_error.'';
} else {
    //echo '[연결성공]';
}

date_default_timezone_set('Asia/Seoul');
//ep 파일 생성될 폴더 경로
$epPath = "tmp"; //상대경로 create_ep_full.php 파일을 실행한 폴더에서부터.
//$epPath = "/home/myuser/tmp"; //절대경로, 지정 가능, 해당 폴더의 퍼미션과 소유자를 적절히 맞춰줘야 합니다.

$MakeHandler = new MakeHandler(MakeHandler::TYPE_SIMPLE);
$MakeHandler->setEpDir($epPath);
$MakeHandler->createFileStart();
$ShopLists = new ShopLists();
$ItemManager = new ItemManage();
//1. 변경된 상품 불러오기
$query = $ItemManager->getChangeListQuery($ShopLists);
$result = $dbConn->query($query) or die($dbConn->error);
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
            $dbConn->query($addQuery);
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
            $dbConn->query($addQuery);
        }
        //쿼리 실행
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
}

//2. 추가된 상품 불러오기
$query = $ItemManager->getNewListQuery($ShopLists);
$result = $dbConn->query($query) or die($dbConn->error);
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
        $dbConn->query($addQuery);

        //쿼리 실행
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
}