<?php

namespace BinSoul\Test\Common\Boxing\Type;

use BinSoul\Common\Boxing\Type\NullValue;

class NullValueTest extends \PHPUnit_Framework_TestCase
{
    public function test_raw()
    {
        $value = new NullValue();
        $this->assertNull($value->raw());
    }

    public function test_to_string()
    {
        $value = new NullValue();
        $this->assertEquals('', $value->__toString());
    }
}
