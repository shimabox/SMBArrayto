<?php

namespace SMB\Arrayto\Plugins\Json;

/**
 * Test of SMB\Arrayto\Plugins\Json\Writer
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class WriterTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Json\Writer */
    protected $target;

    /** @var string */
    protected $actualFileName = '';

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Writer();

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

        $this->target->setFileName($this->actualFileName);
        $this->target->setRows($array);
        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_1.json';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_json_by_addRow()
    {
        $obj = new \stdClass();
        $obj->hoge = '123';
        $obj->piyo = ['abc' => null, 'def' => false];

        $this->target->setFileName($this->actualFileName);
        $this->target->addRow(['key1' => null, 'key2' => true, 'key3' => 0]);
        $this->target->addRow(['url' => 'http://example.net']);
        $this->target->addRow(['arr' => ['foo' => 'bar']]);
        $this->target->addRow(['obj' => $obj]);
        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_1.json';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_json_by_addRowBySpecifyingKV()
    {
        $obj = new \stdClass();
        $obj->hoge = '123';
        $obj->piyo = ['abc' => null, 'def' => false];

        $obj2 = new \stdClass();
        $obj2->hoge = '456';
        $obj2->piyo = ['ghi' => null, 'jkl' => false];

        $this->target->setFileName($this->actualFileName);

        $this->target->addRowBySpecifyingKV('url', 'http://example.net');
        $this->target->addRowBySpecifyingKV('url', 'http://example.org');
        $this->target->addRowBySpecifyingKV('arr', ['foo' => 'bar']);
        $this->target->addRowBySpecifyingKV('arr', ['baz' => 'fuga']);
        $this->target->addRowBySpecifyingKV('obj', $obj);
        $this->target->addRowBySpecifyingKV('obj', $obj2);

        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_2.json';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_json_by_addRowBySpecifyingKV_that_does_not_allow_duplicate_key()
    {
        $obj = new \stdClass();
        $obj->hoge = '123';
        $obj->piyo = ['abc' => null, 'def' => false];

        $obj2 = new \stdClass();
        $obj2->hoge = '456';
        $obj2->piyo = ['ghi' => null, 'jkl' => false];

        $this->target->setFileName($this->actualFileName);

        // It does not allow duplicate key
        $this->target->setAllowDuplicateKey(false);

        $this->target->addRowBySpecifyingKV('url', 'http://example.net');
        $this->target->addRowBySpecifyingKV('url', 'http://example.org');
        $this->target->addRowBySpecifyingKV('arr', ['foo' => 'bar']);
        $this->target->addRowBySpecifyingKV('arr', ['baz' => 'fuga']);
        $this->target->addRowBySpecifyingKV('obj', $obj);
        $this->target->addRowBySpecifyingKV('obj', $obj2);

        $this->target->write();

        $expected = $this->expectedFilePath . 'expected_3.json';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_can_output_to_json_specify_encode_option()
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

        $this->target
             ->setFileName($this->actualFileName)
             ->setJsonEncodeOption(JSON_FORCE_OBJECT | JSON_PRETTY_PRINT)
             ->setRows($array)
             ->write();

        $expected = $this->expectedFilePath . 'expected_4.json';
        $actual   = $this->actualFileName;

        $this->assertFileEquals($expected, $actual);
    }
}