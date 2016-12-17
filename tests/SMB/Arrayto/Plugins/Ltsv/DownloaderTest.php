<?php

namespace SMB\Arrayto\Plugins\Ltsv;

/**
 * Test of SMB\Arrayto\Plugins\Ltsv\Downloader
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class DownloaderTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Ltsv\Downloader */
    protected $target;

    /** @var string */
    protected $actualFileName = '';

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Downloader();

        $this->actualFileName = FIXTURE_FILE_PATH . '/plugins/ltsv/actual/actual.log';
        $this->expectedFilePath = FIXTURE_FILE_PATH . '/plugins/ltsv/expected/';
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
    public function it_can_output_to_ltsv()
    {
        $obj = new \stdClass();
        $obj->hoge = 123;
        $obj->piyo = ['abc' => null, 'def' => false];

        $array = [
            'time' => "[2017-01-01 08:59:60]",
            'foo' => null,
            'bar' => true,
            'buz' => 0,
            'url' => 'http://example.net',
            'arr' => ['foo' => 'bar'],
            'obj' => $obj
        ];

        ob_start();

        $this->target->setRows($array)->download('test.log');

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.log', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file()
    {
        ob_start();

        $this->target->downloadExistsFile($this->expectedFilePath . 'expected_2.log', 'download.log');

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_2.log', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file_by_using_Writer()
    {
        $obj = new \stdClass();
        $obj->hoge = 123;
        $obj->piyo = ['abc' => null, 'def' => false];

        $array = [
            'time' => "[2017-01-01 08:59:60]",
            'foo' => null,
            'bar' => true,
            'buz' => 0,
            'url' => 'http://example.net',
            'arr' => ['foo' => 'bar'],
            'obj' => $obj
        ];

        $writer = new Writer();
        $writer
            ->setFileName($this->actualFileName)
            ->setRows($array);

        ob_start();

        $this->target->downloadExistsFileUsingWriter('test.log', $writer);

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.log', $actual);

        ob_end_clean();
    }
}