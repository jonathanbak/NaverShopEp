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

$query = "CREATE TABLE `nshop_epitem` (
    `ne_uid` int(11) NOT NULL COMMENT '고유 상품 번호',
    `ne_item_hash` varchar(255) DEFAULT NULL COMMENT '변경체크값',
    `ne_send_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '전송 날짜',
    `ne_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '전송데이터 등록일',
    PRIMARY KEY (`ne_uid`),
    KEY `ix_nshop_epitem_ne_uid_hash` (`ne_uid`,`ne_item_hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$dbConn->query($query);