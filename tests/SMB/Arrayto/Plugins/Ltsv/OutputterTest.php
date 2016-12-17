<?php

namespace SMB\Arrayto\Plugins\Ltsv;

use SMB\Arrayto\Ltsv;

/**
 * Test of SMB\Arrayto\Plugins\NullObject
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class OutputterTest extends \TestCaseBase
{
    /**
     * @test
     * @runInSeparateProcess
     */
    public function it_does_not_output_of_Xml()
    {
        $outputter = Ltsv::factory()->getOutputter();

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

        $outputter->setRows($array);

        ob_start();

        $outputter->output();

        $actual = ob_get_contents();

        $this->assertSame('', $actual);

        ob_end_clean();
    }
}