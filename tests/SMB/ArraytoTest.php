<?php

namespace SMB;

/**
 * Test of SMB\Arrayto
 *
 * PHP version 5 >= 5.4
 *
 * @group  SMBArrayto
 * @author shimabox.net
 */
class ArraytoTest extends \TestCaseBase
{
    /**
     * @test
     */
    public function it_can_instantiation()
    {
        $this->assertInstanceOf("\SMB\Arrayto\Json", Arrayto::factory(Arrayto::JSON));
        $this->assertInstanceOf("\SMB\Arrayto\Csv", Arrayto::factory(Arrayto::CSV));
        $this->assertInstanceOf("\SMB\Arrayto\Tsv", Arrayto::factory(Arrayto::TSV));
        $this->assertInstanceOf("\SMB\Arrayto\Ltsv", Arrayto::factory(Arrayto::LTSV));
        $this->assertInstanceOf("\SMB\Arrayto\Xml", Arrayto::factory(Arrayto::XML));
    }

    /**
     * @test
     */
    public function it_throws_an_exception_when_a_not_exist_class_name_is_specified()
    {
        $this->setExpectedException('\InvalidArgumentException');
        Arrayto::factory('jsoooon');
    }
}