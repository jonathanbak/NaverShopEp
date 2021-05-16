# NaverShopEp

네이버쇼핑 상품정보연동 EP3.0 파일 생성 라이브러리 입니다.
국내에서 제공되는 php 연동 API 샘플이 다른 개발 언어에 비해 항상 부족한것 같아 php 동지들을 위해 부족하지만 공개해봅니다.


## Install
```bash
$ composer require jonathanbak/navershopep
```

## Start
네이버쇼핑 연동시 사용할 EP 테이블 생성 
```bash
$ php sql/init.php
```

## Test

테스트 전 샘플 데이터 생성
```bash
$ php sql/test_step1.php
```

phpunit.xml 에 아래 내용을 본인의 MySQL 서버 정보를 넣고
```bash
<php>
    <var name="DB_HOST" value="localhost" />
    <var name="DB_USER" value="test" />
    <var name="DB_PASSWD" value="test1234" />
    <var name="DB_NAME" value="db_test" />
    <var name="DB_PORT" value="3306" />
</php>
```
phpunit 실행하여 테스트 해봅니다.
```bash
$ phpunit

```

## Usage

1. 각 쇼핑몰에 맞게 NaverShopEp\Shop\AbstractLists, NaverShopEp\Shop\AbstractItem 을 상속받아 클래스 작성해주세요.  
2. 지정된 연동시간에 맞춰 실행할 EP생성 스크립트 파일을 만들고 cron 등에 등록하여 ep파일을 생성합니다. 
3. 네이버쇼핑 "쇼핑몰 상품DB URL" 에 등록할 파일 만드셔서 ep파일을 읽어 데이터를 제공합니다.

- samples 폴더의 예제파일들 참고해주세요.

#### 1. 각 쇼핑몰 에 맞게 커스텀 클래스 생성하기

1) Lists 만들기, NaverShopEp\Shop\AbstractLists 를 상속

```php
use NaverShopEp\Shop\AbstractLists;

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
                FROM shop_item WHERE s_status = 1 AND s_nshop_flag = 'Y' LIMIT 5
                ";
        return $query;
    }
}
```

2) Item 만들기, NaverShopEp\Shop\AbstractItem 을 상속

```php
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
```

#### 2. ep 파일 만들기

1) 전체 상품 EP 파일 생성

```php
use NaverShopEp\Ep\Full;
use NaverShopEp\Exception;
use NaverShopEp\ItemManage;
use NaverShopEp\MakeHandler;
use NaverShopEp\Product;

//db커넥
$dbConn = new \mysqli($host, $user, $password, $dbName, $dbPort);

if($dbConn->connect_errno){
    echo '[연결실패] : '.$dbConn->connect_error.'';
} else {
    //echo '[연결성공]';
}

$MakeHandler = new MakeHandler();
$MakeHandler->setEpDir("tmp");
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
```

2) 요약 EP 파일 생성
```php
use NaverShopEp\Ep\Simple;
use NaverShopEp\Exception;
use NaverShopEp\ItemManage;
use NaverShopEp\MakeHandler;
use NaverShopEp\Product;

//db커넥
$dbConn = new \mysqli($host, $user, $password, $dbName, $dbPort);

if($dbConn->connect_errno){
    echo '[연결실패] : '.$dbConn->connect_error.'';
} else {
    //echo '[연결성공]';
}

$MakeHandler = new MakeHandler(MakeHandler::TYPE_SIMPLE);
$MakeHandler->setEpDir("tmp");
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
```

#### EP 파일 읽기

실제 네이버쇼핑 상품DB URL 에 연동할 EP 읽기 소스 입니다. 

```php
use NaverShopEp\Ep\Full;
use NaverShopEp\Ep\Simple;
use NaverShopEp\MakeHandler;

try{
    //요청 시간에 따라 전체 EP, 요약 EP로 나눠서 뿌려준다 EP3.0에서 변경된 요소
    if(date('G')>=10){
        $NhnEpMakeHandler = new MakeHandler( MakeHandler::TYPE_SIMPLE );
        $NhnEpMakeHandler->setEpDir("tmp");
        $NhnEpMakeHandler->setFileHeader(new Simple());
        $contents = $NhnEpMakeHandler->readFile();
        if($contents){
            echo $contents;
        }
    }else{
        $NhnEpMakeHandler = new MakeHandler( MakeHandler::TYPE_FULL );
        $NhnEpMakeHandler->setEpDir("tmp");
        $NhnEpMakeHandler->setFileHeader(new Full());
        $contents = $NhnEpMakeHandler->readFile();
        if($contents){
            echo $contents;
        }
    }

}catch(Exception $e){
    var_dump($e->getMessage());
}
```