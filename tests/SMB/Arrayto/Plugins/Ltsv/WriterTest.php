<?php

namespace SMB\Arrayto\Plugins\Ltsv;

/**
 * Test of SMB\Arrayto\Plugins\Ltsv\Writer
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class WriterTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Ltsv\Writer */
    protected $target;

    /** @var string */
    protected $actualFileName = '';

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Writer();

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

        $this->target->setFileName($this->actualFileName);
        $this->target->setRows($array);
        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_1.log';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_ltsv_change_the_end_of_line_and_file_open_mode()
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

        $this->target
             ->setFileName($this->actualFileName)
             ->setRows($array)
             ->overrideEOL("\r\n")
             ->write();

        $obj2 = new \stdClass();
        $obj2->hoge = 456;
        $obj2->piyo = ['ghi' => null, 'jkl' => false];

        $array2 = [
            'time' => "[2017-01-01 09:00:00]",
            'foo' => null,
            'bar' => true,
            'buz' => 1,
            'url' => 'http://example.org',
            'arr' => ['foo' => 'baz'],
            'obj' => $obj2
        ];

        $this->target
             ->setRows($array2)
             ->overrideEOL("\r\n")
             ->setOpenMode('a')
             ->write();

        $expected = $this->expectedFilePath . 'expected_2.log';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }
}