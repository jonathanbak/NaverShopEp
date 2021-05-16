# NaverShopEp

네이버쇼핑 상품정보연동 EP3.0 파일 생성 라이브러리 샘플 테스트 방법

테스트 진행시 각 파일의 db접속 정보는 개발환경에 맞게 수정해주세요.

## 전체 EP 생성
```bash
-- 샘플데이터 최초 생성 (db 접속 정보 변경하여 사용)
$ php sql/test_step1.php

$ cd samples
-- Full버전 EP 생성 (스크립트 실행 위치 의 tmp 폴더에 생성됨) 
$ php create_ep_full.php
```

## 요약 EP 생성
전체 EP 생성후 진행 가능

```bash
-- 상품 데이터 변경 
$ php sql/test_step2.php

$ cd samples
-- 요약 EP 생성 (스크립트 실행 위치 의 tmp 폴더에 생성됨) 
$ php create_ep_simple.php
```

## 생성한 EP 파일 읽기

```bash
$ php nshop_ep3.php
```