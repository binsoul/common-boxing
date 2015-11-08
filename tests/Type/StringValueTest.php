<?php

namespace BinSoul\Test\Common\Boxing\Type;

use BinSoul\Common\Boxing\Type\StringValue;

class StringValueTest extends \PHPUnit_Framework_TestCase
{
    public function test_raw()
    {
        $value = new StringValue('foobar');
        $this->assertEquals('foobar', $value->raw());
    }

    public function test_length()
    {
        $value = new StringValue('fööbär');
        $this->assertEquals(6, $value->length());
    }

    public function test_to_string()
    {
        $value = new StringValue('foobar');
        $this->assertEquals('foobar', $value->__toString());
    }
}
