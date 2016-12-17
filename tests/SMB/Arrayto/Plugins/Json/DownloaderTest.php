<?php

namespace SMB\Arrayto\Plugins\Json;

/**
 * Test of SMB\Arrayto\Plugins\Json\Downloader
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class DownloaderTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Json\Downloader */
    protected $target;

    /** @var string */
    protected $actualFileName = '';

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Downloader();

        $this->actualFileName = FIXTURE_FILE_PATH . '/plugins/json/actual/actual.json';
        $this->expectedFilePath = FIXTURE_FILE_PATH . '/plugins/json/expected/';
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
    public function it_can_output_to_json()
    {
        $obj = new \stdClass();
        $obj->hoge = '123';
        $obj->piyo = ['abc' => null, 'def' => false];

        $array = [
            ['key1' => null, 'key2' => true, 'key3' => 0],
            ['url' => 'http://example.net'],
            ['arr' => ['foo' => 'bar']],
            ['obj' => $obj]
        ];

        ob_start();

        $this->target->setRows($array)->download('test.json');

        $actual = ob_get_contents();

        $this->assertJsonStringEqualsJsonFile($this->expectedFilePath . 'expected_1.json', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file()
    {
        ob_start();

        $this->target->downloadExistsFile($this->expectedFilePath . 'expected_2.json', 'download.json');

        $actual = ob_get_contents();

        $this->assertJsonStringEqualsJsonFile($this->expectedFilePath . 'expected_2.json', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file_by_using_Writer()
    {
        $obj = new \stdClass();
        $obj->hoge = '123';
        $obj->piyo = ['abc' => null, 'def' => false];

        $array = [
            ['key1' => null, 'key2' => true, 'key3' => 0],
            ['url' => 'http://example.net'],
            ['arr' => ['foo' => 'bar']],
            ['obj' => $obj]
        ];

        $writer = new Writer();
        $writer
            ->setFileName($this->actualFileName)
            ->setRows($array);

        ob_start();

        $this->target->downloadExistsFileUsingWriter('test.csv', $writer);

        $actual = ob_get_contents();

        $this->assertJsonStringEqualsJsonFile($this->expectedFilePath . 'expected_1.json', $actual);

        ob_end_clean();
    }
}