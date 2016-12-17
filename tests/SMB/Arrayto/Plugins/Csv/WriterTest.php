<?php

namespace SMB\Arrayto\Plugins\Csv;

/**
 * Test of SMB\Arrayto\Plugins\Csv\Writer
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class WriterTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Csv\Writer */
    protected $target;

    /** @var string */
    protected $actualFileName = '';

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Writer();

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
     */
    public function it_can_output_to_csv()
    {
        $array = [
            ['apple', 'りんご', '1,000'],
            ['pineapple', 'パインアップル', '800']
        ];

        $this->target->setFileName($this->actualFileName);
        $this->target->setRows($array);
        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_1.csv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_csv_by_addRow()
    {
        $this->target->setFileName($this->actualFileName);
        $this->target->addRow(['apple', 'りんご', '1,000']);
        $this->target->addRow(['pineapple', 'パインアップル', '800']);
        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_1.csv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_csv_by_addRowBySpecifyingKV()
    {
        $this->target->setFileName($this->actualFileName);

        // key is ignored
        $this->target->addRowBySpecifyingKV('fruits1', ['apple', 'りんご', '1,000']);
        $this->target->addRowBySpecifyingKV('fruits2', ['pineapple', 'パインアップル', '800']);

        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_1.csv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_csv_added_to_the_header_row()
    {
        $header = ['name', '名前', 'price'];

        $array = [
            ['apple', 'りんご', '1,000'],
            ['pineapple', 'パインアップル', '800']
        ];

        $this->target
             ->setHeader($header)
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->write();

        $expected = $this->expectedFilePath . 'expected_2.csv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_csv_without_converting_the_character_code()
    {
        $header = ['name', '名前', 'price'];

        $array = [
            ['apple', 'りんご', '1,000'],
            ['pineapple', 'パインアップル', '800']
        ];

        $this->target
             ->setHeader($header)
             ->setToConvert(false)
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->write();

        $expected = $this->expectedFilePath . 'expected_3.csv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_csv_specify_the_file_open_mode()
    {
        $header = ['name', '名前', 'price'];

        $array1 = [
            ['apple', 'りんご', '1,000']
        ];
        $this->target
             ->setHeader($header)
             ->setFileName($this->actualFileName)
             ->setRows($array1)
             ->write();

        $array2 = [
            ['pineapple', 'パインアップル', '800']
        ];
        $this->target
             ->clearHeader()
             ->setOpenMode('a')
             ->setRows($array2)
             ->write();

        $array3 = [
            ['orange', 'オレンジ', '1,234']
        ];
        $this->target
             ->setOpenMode('a')
             ->setRows($array3)
             ->write();

        $expected = $this->expectedFilePath . 'expected_4.csv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_handle_values_with_various_kinds_of_character()
    {
        $header = ['header', 'test,"test"', 'テスト,"テスト"'];

        $array = [
            ['row', 'test,"test"', 'テスト,"テスト"']
        ];

        $this->target
             ->setHeader($header)
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->write();

        $expected = $this->expectedFilePath . 'expected_5.csv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }
}