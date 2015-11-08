<?php

namespace BinSoul\Test\Common\Boxing\Type;

use BinSoul\Common\Boxing\DefaultValueWrapper;
use BinSoul\Common\Boxing\Type\ArrayValue;

class ArrayValueTest extends \PHPUnit_Framework_TestCase
{
    public function test_behaves_like_an_array()
    {
        $wrapper = new DefaultValueWrapper();
        $value = new ArrayValue([1 => 'foo', 'bar' => 1.5], $wrapper);

        $this->assertEquals(2, $value->count());

        $this->assertEquals('foo', $value[1]->raw());
        $this->assertEquals(1.5, $value['bar']->raw());
        $this->assertTrue(isset($value['bar']));
        $this->assertFalse(isset($value['foo']));

        foreach ($value as $key => $val) {
            if ($key === 1) {
                $this->assertEquals('foo', $val->raw());
            } elseif ($key === 'bar') {
                $this->assertEquals(1.5, $val->raw());
            } else {
                $this->fail('Unknown key "'.$key.'"');
            }
        }
    }

    /**
     * @expectedException \LogicException
     */
    public function test_test_cannot_set_value()
    {
        $wrapper = new DefaultValueWrapper();
        $value = new ArrayValue([], $wrapper);

        $value['foo'] = 'bar';
    }

    /**
     * @expectedException \LogicException
     */
    public function test_test_cannot_unset_value()
    {
        $wrapper = new DefaultValueWrapper();
        $value = new ArrayValue([], $wrapper);

        unset($value['foo']);
    }

    public function test_raw()
    {
        $wrapper = new DefaultValueWrapper();
        $value = new ArrayValue([1, 2], $wrapper);

        $this->assertEquals([1, 2], $value->raw());
    }

    public function test_values()
    {
        $wrapper = new DefaultValueWrapper();
        $value = new ArrayValue([1 => 'foo', 'bar' => 1.5], $wrapper);

        $this->assertNotSame($value, $value->keys());
        $this->assertEquals(['foo', 1.5], $value->values()->raw());
    }

    public function test_keys()
    {
        $wrapper = new DefaultValueWrapper();
        $value = new ArrayValue([1 => 'foo', 'bar' => 1.5], $wrapper);

        $this->assertNotSame($value, $value->keys());
        $this->assertEquals([1, 'bar'], $value->keys()->raw());
    }
}
