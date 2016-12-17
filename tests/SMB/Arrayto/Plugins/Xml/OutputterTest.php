<?php

namespace SMB\Arrayto\Plugins\Xml;

use SMB\Arrayto\Xml;

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
        $outputter = Xml::factory()->getOutputter();

        $array = [
            'Good guy' => [
                'name' => 'Luke Skywalker',
                'weapon' => 'Lightsaber'
            ],
            'Bad guy' => [
                'name' => 'Sauron',
                'weapon' => 'Evil Eye'
            ]
        ];

        $outputter->setRows($array);

        ob_start();

        $outputter->output();

        $actual = ob_get_contents();

        $this->assertSame('', $actual);

        ob_end_clean();
    }
}