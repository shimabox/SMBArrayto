<?php

namespace SMB\Arrayto;

/**
 * Test of SMB\Arrayto\Json
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class JsonTest extends \TestCaseBase
{
    /**
     * @test
     */
    public function it_can_instantiation()
    {
        $json = Json::factory();

        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Json\Downloader", $json->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Json\Outputter", $json->getOutputter());
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Json\Writer", $json->getWriter());

        // interface
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Downloadable", $json->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Outputable", $json->getOutputter());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Writable", $json->getWriter());
    }
}