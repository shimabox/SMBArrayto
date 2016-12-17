<?php

namespace SMB\Arrayto;

/**
 * Test of SMB\Arrayto\Xml
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class XmlTest extends \TestCaseBase
{
    /**
     * @test
     */
    public function it_can_instantiation()
    {
        $xml = Xml::factory();

        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Xml\Downloader", $xml->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Xml\Writer", $xml->getWriter());

        // NullObject
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\NullObject", $xml->getOutputter());

        // interface
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Downloadable", $xml->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Outputable", $xml->getOutputter());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Writable", $xml->getWriter());
    }
}