<?php

namespace SMB\Arrayto\Plugins\Csv;

/**
 * Test of SMB\Arrayto\Plugins\Csv\Outputter
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class OutputterTest extends \TestCaseBase
{
    /** @var SMB\Arrayto\Plugins\Csv\Outputter */
    protected $target;

    /** @var string */
    protected $expectedFilePath = '';

    public function setUp()
    {
        parent::setUp();

        $this->target = new Outputter();

        $this->expectedFilePath = FIXTURE_FILE_PATH . '/plugins/csv/expected/';
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_can_output_to_csv()
    {
        $array = [
            ['apple', 'りんご', '1,000'],
            ['pineapple', 'パインアップル', '800']
        ];

        ob_start();

        $this->target->setRows($array)->output();

        $actual = ob_get_contents();

        $this->assertStringEqualsFile($this->expectedFilePath . 'expected_1.csv', $actual);

        ob_end_clean();
    }
}