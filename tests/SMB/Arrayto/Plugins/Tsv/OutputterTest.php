<?php

namespace SMB\Arrayto\Plugins\Tsv;

/**
 * Test of SMB\Arrayto\Plugins\Tsv\Outputter
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class OutputterTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Tsv\Outputter */
    protected $target;

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Outputter();

        $this->expectedFilePath = FIXTURE_FILE_PATH . '/plugins/tsv/expected/';
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_output_to_tsv()
    {
        $array = [
            ['apple', 'りんご', "Sweet\tRed"],
            ['pineapple', 'パインアップル', "Sour\tYellow"]
        ];

        ob_start();

        $this->target->setRows($array)->output();

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.tsv', $actual);

        ob_end_clean();
    }
}