<?php

namespace BinSoul\Test\Common\Boxing\Type;

use BinSoul\Common\Boxing\DefaultValueWrapper;
use BinSoul\Common\Boxing\Type\ObjectValue;

class ObjectValueTest extends \PHPUnit_Framework_TestCase
{
    public function test_raw()
    {
        $wrapper = new DefaultValueWrapper();

        $object = new \stdClass();
        $value = new ObjectValue($object, $wrapper);

        $this->assertSame($object, $value->raw());
    }

    public function test_get()
    {
        $wrapper = new DefaultValueWrapper();

        $object = new \stdClass();
        $object->strValue = 'foobar';
        $object->intValue = 1;

        $value = new ObjectValue($object, $wrapper);

        $this->assertEquals('foobar', $value->strValue->raw());
        $this->assertEquals(1, $value->intValue->raw());
    }

    /**
     * @expectedException \LogicException
     */
    public function test_test_cannot_set_value()
    {
        $wrapper = new DefaultValueWrapper();
        $value = new ObjectValue(new \stdClass(), $wrapper);

        $value->foo = 'bar';
    }
}
