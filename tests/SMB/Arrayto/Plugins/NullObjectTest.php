<?php

namespace SMB\Arrayto\Plugins;

use SMB\Arrayto\Plugins\Json\Writer;

/**
 * Test of SMB\Arrayto\Plugins\NullObject
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class NullObjectTest extends \TestCaseBase
{
    /**
     * @test
     */
    public function it_does_not_do_anything()
    {
        $target = new NullObject();

        $this->assertNull($target->download(''));
        $this->assertNull($target->downloadExistsFile(''));
        $this->assertNull($target->downloadExistsFileUsingWriter('', new Writer()));

        $this->assertNull($target->write());

        $this->assertNull($target->output());
    }
}