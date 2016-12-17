<?php

namespace SMB\Arrayto\Plugins\Tsv;

/**
 * Test of SMB\Arrayto\Plugins\Tsv\Downloader
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class DownloaderTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Tsv\Downloader */
    protected $target;

    /** @var string */
    protected $actualFileName = '';

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Downloader();

        $this->actualFileName = FIXTURE_FILE_PATH . '/plugins/csv/actual/actual.csv';
        $this->expectedFilePath = FIXTURE_FILE_PATH . '/plugins/tsv/expected/';
    }

    public function tearDown()
    {
        parent::tearDown();

        if (file_exists($this->actualFileName)) {
            unlink($this->actualFileName);
        }
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_output_to_tsv()
    {
        $array = [
            ['apple', 'りんご', "Sweet\tRed"],
            ['pineapple', 'パインアップル', "Sour\tYellow"]
        ];

        ob_start();

        $this->target->setRows($array)->download('test.tsv');

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.tsv', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file()
    {
        ob_start();

        $this->target->downloadExistsFile($this->expectedFilePath . 'expected_2.tsv', 'download.tsv');

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_2.tsv', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file_by_using_Writer()
    {
        $array = [
            ['apple', 'りんご', "Sweet\tRed"],
            ['pineapple', 'パインアップル', "Sour\tYellow"]
        ];
        $writer = new Writer();
        $writer
            ->setFileName($this->actualFileName)
            ->setRows($array);

        ob_start();

        $this->target->downloadExistsFileUsingWriter('test.tsv', $writer);

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.tsv', $actual);

        ob_end_clean();
    }
}