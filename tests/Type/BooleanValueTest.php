<?php

namespace BinSoul\Test\Common\Boxing\Type;

use BinSoul\Common\Boxing\Type\BooleanValue;

class BooleanValueTest extends \PHPUnit_Framework_TestCase
{
    public function test_raw()
    {
        $value = new BooleanValue(true);
        $this->assertTrue($value->isTrue());
        $this->assertFalse($value->isFalse());
        $this->assertTrue($value->raw());

        $value = new BooleanValue(false);
        $this->assertTrue($value->isFalse());
        $this->assertFalse($value->isTrue());
        $this->assertFalse($value->raw());
    }

    public function test_negate()
    {
        $value = new BooleanValue(true);

        $this->assertNotSame($value, $value->negate());
        $this->assertFalse($value->negate()->raw());
    }

    public function test_to_string()
    {
        $value = new BooleanValue(true);
        $this->assertEquals('true', $value->__toString());

        $value = new BooleanValue(false);
        $this->assertEquals('false', $value->__toString());
    }
}
