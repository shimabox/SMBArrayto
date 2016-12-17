<?php

namespace SMB\Arrayto\Plugins\Json;

/**
 * Test of SMB\Arrayto\Plugins\Json\Outputter
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class OutputterTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Json\Outputter */
    protected $target;

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Outputter();

        $this->expectedFilePath = FIXTURE_FILE_PATH . '/plugins/json/expected/';
    }

    public function tearDown()
    {
        parent::tearDown();
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

        $this->target->setRows($array)->output();

        $actual = ob_get_contents();

        $this->assertJsonStringEqualsJsonFile($this->expectedFilePath . 'expected_1.json', $actual);

        ob_end_clean();
    }
}