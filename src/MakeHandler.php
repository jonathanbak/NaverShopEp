<?php
/**
 * EP 생성하기
 * Author: jonathanbak
 */
namespace NaverShopEp;

class MakeHandler
{
    const INIT = true; //파일 초기화
    const TYPE_FULL = 'full';
    const TYPE_SIMPLE = 'simple';
    const FULL_FILE_NAME = '/{{DATE}}_product.txt';
    const SIMPLE_FILE_NAME = '/{{DATE}}_simple_{{TIME}}.txt';

    protected $type = '';
    protected $productList = array();
    protected $rootDir = null;
    protected $isReset = false;
    protected $fileName = null;

    public function __construct($type = '')
    {
        $this->type = ($type=='')? self::TYPE_FULL : $type;
    }

    public function setEpDir($epDir)
    {
        $this->rootDir = $epDir;
        if(!is_dir($this->rootDir)){
            mkdir($this->rootDir);
        }
        if(!is_dir($this->rootDir)){
            throw new Exception('해당 폴더가 없습니다. EP파일을 생성할 디렉토리 경로를 확인해주세요. - '. $this->rootDir);
        }
    }

    public function add( $NhnEpProduct )
    {
        $this->productList[] = $NhnEpProduct;
    }

    public function createFileStart()
    {
        $contents = '';
        $this->isReset = self::INIT;
        $this->writeFile($contents, self::INIT);
    }

    public function createFileContent( $item )
    {
        if($this->isReset){
            $contents = $item;
            $this->isReset = false;
        }else {
            $contents = "\n". $item;
        }

        $this->writeFile($contents);
    }

    public function setFileHeader($Product)
    {
        $properties = $Product->getProperties();
        $keyList = [];
        foreach($properties as $key => $val){
            $keyList[] = $key=='tclass'? 'class' : $key;
        }

        $contents = ''.implode("\t",$keyList);
        echo $contents."\n";
    }

    protected function writeFile( $contents, $isReset = false )
    {
        $epDir = $this->rootDir;

        $today = date("Ymd");

        if($this->type==self::TYPE_FULL){
            $this->fileName = str_replace('{{DATE}}',$today,self::FULL_FILE_NAME);
            $fileName = $epDir . $this->fileName;
            if($isReset){
                if(is_file($fileName)) unlink($fileName);
            } else file_put_contents($fileName, $contents, FILE_APPEND);
        }else{
            $nowTime = date("Hi");
            $fileTime = '0800';
            if($nowTime < '0800'){
                $fileTime = '0800';
            }else if($nowTime < '1000'){
                $fileTime = '1000';
            }else if($nowTime < '1200'){
                $fileTime = '1200';
            }else if($nowTime < '1400'){
                $fileTime = '1400';
            }else if($nowTime < '1600'){
                $fileTime = '1600';
            }else if($nowTime < '1800'){
                $fileTime = '1800';
            }else if($nowTime < '2000'){
                $fileTime = '2000';
            }
            $this->fileName = str_replace('{{TIME}}',$fileTime, str_replace('{{DATE}}',$today,self::SIMPLE_FILE_NAME) );
            $fileName = $epDir . $this->fileName;
            if($isReset){
                if(is_file($fileName)) unlink($fileName);
            } else file_put_contents($fileName, $contents, FILE_APPEND);
        }
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * EP 파일 불러오기
     * @return string
     */
    public function readFile()
    {
        $epDir = $this->rootDir;

        $today = date("Ymd");

        $contents = '';
        if($this->type==self::TYPE_FULL){
            $fileName = $epDir . str_replace('{{DATE}}',$today,self::FULL_FILE_NAME);
            if(is_file($fileName)) $contents = file_get_contents($fileName);
        }else{
            //기본 풀버전도 불러온다 - 풀버전 불러오면 어찌될려나.. 뭔가 이상해 쩝
            $fileName = $epDir . str_replace('{{DATE}}',$today,self::FULL_FILE_NAME);
            if(is_file($fileName)) {
//                $contents = file_get_contents($fileName);
                $fullContents = file($fileName);
                // To check the number of lines
                $contents = '';
                foreach($fullContents as $line)
                {
//                    echo $line.'<br>';
                    $contents .= str_replace("\n",'',$line)."\tI\t".date("Y-m-d 08:00:00")."\n";
                }
            }

            $fileNameByDate = str_replace('{{DATE}}',$today,self::SIMPLE_FILE_NAME);
            $nowTime = date("Hi");
            $fileTime = '0800';
            if($nowTime < '1200'){
//                $fileTime = '0800';
//                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
//                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1000';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName);
            }else if($nowTime < '1400'){
//                $fileTime = '0800';
//                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
//                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1000';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1200';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName);
            }else if($nowTime < '1600'){
//                $fileTime = '0800';
//                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
//                if(is_file($fileName)) $contents = file_get_contents($fileName)."\n";
                $fileTime = '1000';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1200';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1400';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName);
            }else if($nowTime < '1800'){
//                $fileTime = '0800';
//                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
//                if(is_file($fileName)) $contents = file_get_contents($fileName)."\n";
                $fileTime = '1000';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1200';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1400';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1600';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName);
            }else if($nowTime < '2000'){
//                $fileTime = '0800';
//                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
//                if(is_file($fileName)) $contents = file_get_contents($fileName)."\n";
                $fileTime = '1000';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1200';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1400';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1600';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1800';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName);
            }else if($nowTime < '2400'){
//                $fileTime = '0800';
//                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
//                if(is_file($fileName)) $contents = file_get_contents($fileName)."\n";
                $fileTime = '1000';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1200';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1400';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1600';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '1800';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName)."\n";
                $fileTime = '2000';
                $fileName = $epDir . str_replace('{{TIME}}',$fileTime, $fileNameByDate );
                if(is_file($fileName)) $contents .= file_get_contents($fileName);
            }
        }

        return $contents;
    }
}