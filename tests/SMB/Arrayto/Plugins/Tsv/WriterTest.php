<?php

namespace SMB\Arrayto\Plugins\Tsv;

/**
 * Test of SMB\Arrayto\Plugins\Tsv\Writer
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class WriterTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Tsv\Writer */
    protected $target;

    /** @var string */
    protected $actualFileName = '';

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Writer();

        $this->actualFileName = FIXTURE_FILE_PATH . '/plugins/tsv/actual/actual.tsv';
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
     */
    public function it_can_output_to_tsv()
    {
        $array = [
            ['apple', 'りんご', "Sweet\tRed"],
            ['pineapple', 'パインアップル', "Sour\tYellow"]
        ];

        $this->target->setFileName($this->actualFileName);
        $this->target->setRows($array);
        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_1.tsv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_tsv_by_addRow()
    {
        $this->target->setFileName($this->actualFileName);
        $this->target->addRow(['apple', 'りんご', "Sweet\tRed"]);
        $this->target->addRow(['pineapple', 'パインアップル', "Sour\tYellow"]);
        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_1.tsv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_tsv_by_addRowBySpecifyingKV()
    {
        $this->target->setFileName($this->actualFileName);

        // key is ignored
        $this->target->addRowBySpecifyingKV('fruits1', ['apple', 'りんご', "Sweet\tRed"]);
        $this->target->addRowBySpecifyingKV('fruits2', ['pineapple', 'パインアップル', "Sour\tYellow"]);

        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_1.tsv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_tsv_added_to_the_header_row()
    {
        $header = ['name', '名前', 'feature'];

        $array = [
            ['apple', 'りんご', "Sweet\tRed"],
            ['pineapple', 'パインアップル', "Sour\tYellow"]
        ];

        $this->target
             ->setHeader($header)
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->write();

        $expected = $this->expectedFilePath . 'expected_2.tsv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_tsv_without_converting_the_character_code()
    {
        $header = ['name', '名前', 'feature'];

        $array = [
            ['apple', 'りんご', "Sweet\tRed"],
            ['pineapple', 'パインアップル', "Sour\tYellow"]
        ];

        $this->target
             ->setHeader($header)
             ->setToConvert(false)
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->write();

        $expected = $this->expectedFilePath . 'expected_3.tsv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_csv_specify_the_file_open_mode()
    {
        $header = ['name', '名前', 'feature'];

        $array1 = [
            ['apple', 'りんご', "Sweet\tRed"]
        ];
        $this->target
             ->setHeader($header)
             ->setFileName($this->actualFileName)
             ->setRows($array1)
             ->write();

        $array2 = [
            ['pineapple', 'パインアップル', "Sour\tYellow"]
        ];
        $this->target
             ->clearHeader()
             ->setOpenMode('a')
             ->setRows($array2)
             ->write();

        $array3 = [
            ['orange', 'オレンジ', "Juicy\tOrange"]
        ];
        $this->target
             ->setOpenMode('a')
             ->setRows($array3)
             ->write();

        $expected = $this->expectedFilePath . 'expected_4.tsv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_handle_values_with_various_kinds_of_character()
    {
        $header = ['name', '名前', "feature\tColor"];

        $array = [
            ['apple', 'り"ん"ご', "sweet\tRed"]
        ];

        $this->target
             ->setHeader($header)
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->write();

        $expected = $this->expectedFilePath . 'expected_5.tsv';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }
}