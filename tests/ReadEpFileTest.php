<?php

namespace NaverShopEpTest;

use NaverShopEp\Ep\Full;
use NaverShopEp\Ep\Simple;
use NaverShopEp\MakeHandler;

/**
 * Shop\Item
 */
class ReadEpFileTest extends \PHPUnit\Framework\TestCase
{
    public function testReadFullEp()
    {
        $NhnEpMakeHandler = new MakeHandler( MakeHandler::TYPE_FULL );
        $NhnEpMakeHandler->setEpDir(CreateEpFileTest::EP_DIR);
        $NhnEpMakeHandler->setFileHeader(new Full());
        $contents = $NhnEpMakeHandler->readFile();
        if($contents){
            echo $contents;
        }

        $this->assertTrue(strlen($contents)>0);
    }

    public function testReadSimpleEp()
    {
        $NhnEpMakeHandler = new MakeHandler( MakeHandler::TYPE_SIMPLE );
        $NhnEpMakeHandler->setEpDir(CreateEpFileTest::EP_DIR);
        $NhnEpMakeHandler->setFileHeader(new Simple());
        $contents = $NhnEpMakeHandler->readFile();
        if($contents){
            echo $contents;
        }

        $this->assertTrue(strlen($contents)>0);
    }
}