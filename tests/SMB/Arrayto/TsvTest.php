<?php

namespace SMB\Arrayto;

/**
 * Test of SMB\Arrayto\Tsv
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class TsvTest extends \TestCaseBase
{
    /**
     * @test
     */
    public function it_can_instantiation()
    {
        $tsv = Tsv::factory();

        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Tsv\Downloader", $tsv->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Tsv\Outputter", $tsv->getOutputter());
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Tsv\Writer", $tsv->getWriter());

        // interface
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Downloadable", $tsv->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Outputable", $tsv->getOutputter());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Writable", $tsv->getWriter());
    }
}