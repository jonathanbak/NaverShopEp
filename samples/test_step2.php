<?php
include_once("./db.inc.php");
global $host, $user, $password, $dbName, $dbPort;

$dbConn = new \mysqli($host, $user, $password, $dbName, $dbPort);

if($dbConn->connect_errno){
    echo '[DB 연결실패] : '.$dbConn->connect_error.'';
} else {
//    echo '[연결성공]';
}

//수정
$query = "UPDATE shop_item SET s_img_url = '/image/goods/3_1.jpg', s_last_update = now() WHERE s_idx = 3";
$result = $dbConn->query($query);
if($result) echo ".";
else echo "F";
//재고 품절
$query = "UPDATE shop_item SET s_stock = 0, s_last_update = now() WHERE s_idx = 4";
$result = $dbConn->query($query);
if($result) echo ".";
else echo "F";
//추가
$query = "INSERT INTO shop_item (s_idx, s_goods_name, s_category, s_img_url, s_price, s_stock, s_status, s_nshop_flag, s_last_update)
                    values
                    ('7','상품7','카테7','/image/goods/7.jpg','11000','20','1','Y',now()),
                    ('8','상품8','카테7','/image/goods/8.jpg','12300','10','1','Y',now()),
                    ('9','상품9','카테7','/image/goods/9.jpg','1100','30','1','Y',now())";
$result = $dbConn->query($query);
if($result) echo ".";
else echo "F";

echo "OK\n";