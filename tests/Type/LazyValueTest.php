<?php

namespace BinSoul\Test\Common\Boxing\Type;

use BinSoul\Common\Boxing\DefaultValueWrapper;
use BinSoul\Common\Boxing\Type\LazyValue;
use BinSoul\Common\Boxing\Type\StringValue;

class LazyValueTest extends \PHPUnit_Framework_TestCase
{
    public function test_resolve()
    {
        $wrapper = new DefaultValueWrapper();

        $called = false;
        $value = new LazyValue(
            function () use (&$called) {
                $called = true;

                return 'foobar';
            },
            $wrapper
        );

        $generated = $value->resolve();
        $this->assertTrue($called);
        $this->assertInstanceOf(StringValue::class, $generated);
    }

    public function test_raw()
    {
        $wrapper = new DefaultValueWrapper();

        $value = new LazyValue(
            function () {
                return 'foobar';
            },
            $wrapper
        );

        $this->assertEquals('foobar', $value->raw());
    }

    public function test_to_string()
    {
        $wrapper = new DefaultValueWrapper();

        $value = new LazyValue(
            function () {
                return 'foobar';
            },
            $wrapper
        );

        $this->assertEquals('foobar', $value->__toString());
    }
}
