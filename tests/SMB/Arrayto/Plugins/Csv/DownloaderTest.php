<?php

namespace SMB\Arrayto\Plugins\Csv;

/**
 * Test of SMB\Arrayto\Plugins\Csv\Downloader
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class DownloaderTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Csv\Downloader */
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
        $this->expectedFilePath = FIXTURE_FILE_PATH . '/plugins/csv/expected/';
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
    public function it_can_output_to_csv()
    {
        $array = [
            ['apple', 'りんご', '1,000'],
            ['pineapple', 'パインアップル', '800']
        ];

        ob_start();

        $this->target->setRows($array)->download('test.csv');

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.csv', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file()
    {
        ob_start();

        $this->target->downloadExistsFile($this->expectedFilePath . 'expected_2.csv', 'download.csv');

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_2.csv', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file_by_using_Writer()
    {
        $array = [
            ['apple', 'りんご', '1,000'],
            ['pineapple', 'パインアップル', '800']
        ];
        $writer = new Writer();
        $writer
            ->setFileName($this->actualFileName)
            ->setRows($array);

        ob_start();

        $this->target->downloadExistsFileUsingWriter('test.csv', $writer);

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.csv', $actual);

        ob_end_clean();
    }
}