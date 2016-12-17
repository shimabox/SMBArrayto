<?php

namespace SMB\Arrayto;

/**
 * Test of SMB\Arrayto\Ltsv
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class LtsvTest extends \TestCaseBase
{
    /**
     * @test
     */
    public function it_can_instantiation()
    {
        $ltsv = Ltsv::factory();

        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Ltsv\Downloader", $ltsv->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Ltsv\Writer", $ltsv->getWriter());

        // NullObject
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\NullObject", $ltsv->getOutputter());

        // interface
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Downloadable", $ltsv->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Outputable", $ltsv->getOutputter());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Writable", $ltsv->getWriter());
    }
}