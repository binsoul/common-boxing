<?php

namespace BinSoul\Test\Common\Boxing;

use BinSoul\Common\Boxing\DefaultValueWrapper;
use BinSoul\Common\Boxing\Type\ArrayValue;
use BinSoul\Common\Boxing\Type\BooleanValue;
use BinSoul\Common\Boxing\Type\LazyValue;
use BinSoul\Common\Boxing\Type\NumberValue;
use BinSoul\Common\Boxing\Type\ObjectValue;
use BinSoul\Common\Boxing\Type\StringValue;

class DefaultValueWrapperTest extends \PHPUnit_Framework_TestCase
{
    public function types()
    {
        return [
            ['string', StringValue::class],
            [1, NumberValue::class],
            [1.5, NumberValue::class],
            [true, BooleanValue::class],
            [new \stdClass(), ObjectValue::class],
            [[1, 2], ArrayValue::class],
            [function () {}, LazyValue::class],
            [new StringValue('foobar'), StringValue::class],
        ];
    }

    /**
     * @param $value
     * @param $class
     *
     * @dataProvider types
     */
    public function test_creates_types($value, $class)
    {
        $wrapper = new DefaultValueWrapper();

        $this->assertInstanceOf($class, $wrapper->box($value));
    }

    public function test_resolves_lazy_value()
    {
        $wrapper = new DefaultValueWrapper();

        $called = false;
        $value = new LazyValue(function () use (&$called) {
            $called = true;

            return 'foobar';
        }, $wrapper);

        $boxedValue = $wrapper->box($value);

        $this->assertTrue($called);
        $this->assertInstanceOf(StringValue::class, $boxedValue);
    }
}
