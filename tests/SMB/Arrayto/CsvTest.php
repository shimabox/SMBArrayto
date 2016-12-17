<?php

namespace SMB\Arrayto;

/**
 * Test of SMB\Arrayto\Csv
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class CsvTest extends \TestCaseBase
{
    /**
     * @test
     */
    public function it_can_instantiation()
    {
        $csv = Csv::factory();

        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Csv\Downloader", $csv->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Csv\Outputter", $csv->getOutputter());
        $this->assertInstanceOf("\SMB\Arrayto\Plugins\Csv\Writer", $csv->getWriter());

        // interface
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Downloadable", $csv->getDownloader());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Outputable", $csv->getOutputter());
        $this->assertInstanceOf("\SMB\Arrayto\Interfaces\Writable", $csv->getWriter());
    }
}