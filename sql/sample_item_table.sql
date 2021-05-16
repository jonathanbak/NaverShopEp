CREATE TABLE `shop_item` (
    `s_idx` int(11) NOT NULL COMMENT '고유 상품 번호',
    `s_goods_name` varchar(255) DEFAULT NULL COMMENT '상품명',
    `s_img_url` varchar(255) DEFAULT NULL COMMENT '상품 이미지',
    `s_price` int(11) DEFAULT NULL COMMENT '상품가격',
    `s_stock` int(11) DEFAULT NULL COMMENT '재고수량',
    `s_status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '판매상태 1:판매, 0:준비중(판매중지), 9:품절',
    `s_nshop_flag` enum('Y','N') DEFAULT NULL COMMENT '네이버쇼핑 전송 Y:사용,N:사용안함',
    `s_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일',
    `s_last_update` datetime NULL COMMENT '마지막 수정일시',
    PRIMARY KEY (`s_idx`),
    KEY `ix_shop_item_nshop_date` (`s_nshop_flag`,`s_last_update`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '상품 정보';

insert into shop_item (s_idx, s_goods_name, s_img_url, s_price, s_stock, s_status, s_nshop_flag, s_last_update)
values
('1','상품1','/image/goods/1.jpg','3000','10','1','Y','2021-05-13 05:55:00'),
('2','상품2','/image/goods/2.jpg','12000','20','1','Y','2021-05-14 05:55:00'),
('3','상품3','/image/goods/3.jpg','30000','100','1','Y','2021-05-15 05:55:00'),
('4','상품4','/image/goods/4.jpg','28000','0','1','Y','2021-05-15 05:55:00'),
('5','상품5','/image/goods/5.jpg','113000','4','0','N','2021-05-15 05:55:00'),
('6','상품6','/image/goods/6.jpg','13000','10','1','Y','2021-05-15 05:55:00');