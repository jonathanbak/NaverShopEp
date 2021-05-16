<?php
define('__SITE_ROOT__', dirname(__DIR__));
require __SITE_ROOT__ . "/vendor/autoload.php";

include_once("./db.inc.php");
include_once("./shop.class.php");
use NaverShopEp\Ep\Full;
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
//    echo '[연결성공]';
}

date_default_timezone_set('Asia/Seoul');
//ep 파일 생성될 폴더 경로
$epPath = "tmp"; //상대경로 create_ep_full.php 파일을 실행한 폴더에서부터.
//$epPath = "/home/myuser/tmp"; //절대경로, 지정 가능, 해당 폴더의 퍼미션과 소유자를 적절히 맞춰줘야 합니다.

$MakeHandler = new MakeHandler();
$MakeHandler->setEpDir($epPath);
$MakeHandler->createFileStart();
$ShopLists = new ShopLists();
$ItemManager = new ItemManage();
$query = $ItemManager->getAllQuery($ShopLists);
//1. 쿼리 실행
$result = $dbConn->query($query) or die($dbConn->error);
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
        $dbConn->query($addQuery);
        //쿼리 실행
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
}