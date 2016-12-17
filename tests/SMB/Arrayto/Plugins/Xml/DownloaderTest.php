<?php

namespace SMB\Arrayto\Plugins\Xml;

/**
 * Test of SMB\Arrayto\Plugins\Xml\Downloader
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class DownloaderTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Xml\Downloader */
    protected $target;

    /** @var string */
    protected $actualFileName = '';

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Downloader();

        $this->actualFileName = FIXTURE_FILE_PATH . '/plugins/xml/actual/actual.xml';
        $this->expectedFilePath = FIXTURE_FILE_PATH . '/plugins/xml/expected/';
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
    public function it_can_output_to_xml()
    {
        $array['book'] = [
            [
                '_attributes' => ['category' => 'children', 'currency' => 'USD'],
                'tilte' => [
                    '_attributes' => ['lang' => 'en'],
                    '_value' => 'Harry Potter'
                ],
                'author' => 'J K. Rowling',
                'year' => 2005,
                'price' => 29.99
            ],
            [
                '_attributes' => ['category' => 'music', 'currency' => 'JPY'],
                'tilte' => [
                    '_attributes' => ['lang' => 'ja'],
                    '_value' => '[score] Boys&Gilrs'
                ],
                'author' => 'GOING STEADY(銀杏BOYZ)',
                'year' => 2000,
                'price' => "2,808"
            ]
        ];

        ob_start();

        $this->target->setRows($array);

        $this->target->setRootElementName('bookstore')->download('test.xml');

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.xml', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file()
    {
        ob_start();

        $this->target->downloadExistsFile($this->expectedFilePath . 'expected_2.xml', 'download.xml');

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_2.xml', $actual);

        ob_end_clean();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_download_an_existing_file_by_using_Writer()
    {
        $array['book'] = [
            [
                '_attributes' => ['category' => 'children', 'currency' => 'USD'],
                'tilte' => [
                    '_attributes' => ['lang' => 'en'],
                    '_value' => 'Harry Potter'
                ],
                'author' => 'J K. Rowling',
                'year' => 2005,
                'price' => 29.99
            ],
            [
                '_attributes' => ['category' => 'music', 'currency' => 'JPY'],
                'tilte' => [
                    '_attributes' => ['lang' => 'ja'],
                    '_value' => '[score] Boys&Gilrs'
                ],
                'author' => 'GOING STEADY(銀杏BOYZ)',
                'year' => 2000,
                'price' => "2,808"
            ]
        ];

        $writer = new Writer();
        $writer
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->setRootElementName('bookstore');

        ob_start();

        $this->target->downloadExistsFileUsingWriter('test.xml', $writer);

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.xml', $actual);

        ob_end_clean();
    }
}