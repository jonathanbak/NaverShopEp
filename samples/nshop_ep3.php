<?php
define('__SITE_ROOT__', dirname(__DIR__));
require __SITE_ROOT__ . "/vendor/autoload.php";

use NaverShopEp\Ep\Full;
use NaverShopEp\Ep\Simple;
use NaverShopEp\MakeHandler;

date_default_timezone_set('Asia/Seoul'); //timezone 정확히 지정되었는지 체크 필요

$epPath = "tmp"; //상대경로 create_ep_full.php 파일을 실행한 폴더에서부터.
//$epPath = "/home/myuser/tmp"; //절대경로, 지정 가능, 해당 폴더의 퍼미션과 소유자를 적절히 맞춰줘야 합니다.
try{
    //요청 시간에 따라 전체 EP, 요약 EP로 나눠서 뿌려준다 EP3.0에서 변경된 요소
    if(date('G')>=10){
        $NhnEpMakeHandler = new MakeHandler( MakeHandler::TYPE_SIMPLE );
        $NhnEpMakeHandler->setEpDir($epPath);
        $NhnEpMakeHandler->setFileHeader(new Simple());
        $contents = $NhnEpMakeHandler->readFile();
        if($contents){
            echo $contents;
        }
    }else{
        $NhnEpMakeHandler = new MakeHandler( MakeHandler::TYPE_FULL );
        $NhnEpMakeHandler->setEpDir($epPath);
        $NhnEpMakeHandler->setFileHeader(new Full());
        $contents = $NhnEpMakeHandler->readFile();
        if($contents){
            echo $contents;
        }
    }

}catch(Exception $e){
    var_dump($e->getMessage());
}