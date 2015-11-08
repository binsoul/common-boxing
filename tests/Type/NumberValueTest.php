<?php

namespace BinSoul\Test\Common\Boxing\Type;

use BinSoul\Common\Boxing\Type\NumberValue;

class NumberValueTest extends \PHPUnit_Framework_TestCase
{
    public function test_raw()
    {
        $value = new NumberValue(1.5);
        $this->assertEquals(1.5, $value->raw());
    }

    public function test_round()
    {
        $value = new NumberValue(1.5678);
        $rounded = $value->round(2);

        $this->assertNotSame($rounded, $value);
        $this->assertEquals(1.57, $rounded->raw());
    }

    public function test_format()
    {
        $value = new NumberValue(1001.5678);
        $this->assertEquals('1.001,57', $value->format(2, ',', '.'));
    }

    public function test_to_string()
    {
        $value = new NumberValue(1001.5678);
        $this->assertEquals((string) 1001.5678, $value->__toString());
    }
}
