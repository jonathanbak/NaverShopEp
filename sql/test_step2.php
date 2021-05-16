<?php
$host = "localhost";
$user = "test";
$password = "test1234";
$dbName = "db_test";
$dbPort = "3306";

$dbConn = new \mysqli($host, $user, $password, $dbName, $dbPort);

if($dbConn->connect_errno){
    echo '[연결실패] : '.$dbConn->connect_error.'';
} else {
//    echo '[연결성공]';
}

//수정
$query = "UPDATE shop_item SET s_img_url = '/image/goods/3_1.jpg', s_last_update = now() WHERE s_idx = 3";
$dbConn->query($query);

//재고 품절
$query = "UPDATE shop_item SET s_stock = 0, s_last_update = now() WHERE s_idx = 4";
$dbConn->query($query);

//추가
$query = "INSERT INTO shop_item (s_idx, s_goods_name, s_img_url, s_price, s_stock, s_status, s_nshop_flag, s_last_update)
                    values
                    ('7','상품7','/image/goods/7.jpg','11000','20','1','Y',now()),
                    ('8','상품8','/image/goods/8.jpg','12300','10','1','Y',now()),
                    ('9','상품9','/image/goods/9.jpg','1100','30','1','Y',now())";
$dbConn->query($query);
