<?php

namespace SMB\Arrayto\Plugins\Xml;

/**
 * Test of SMB\Arrayto\Plugins\Xml\Writer
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class WriterTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Xml\Writer */
    protected $target;

    /** @var string */
    protected $actualFileName = '';

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Writer();

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

        $this->target
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->setRootElementName('bookstore')
             ->write();

        $expected = $this->expectedFilePath . 'expected_1.xml';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_xml_without_format()
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

        $this->target
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->setRootElementName('bookstore')
             ->toFormatOutput(false)
             ->write();

        $expected = $this->expectedFilePath . 'expected_3.xml';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }
}