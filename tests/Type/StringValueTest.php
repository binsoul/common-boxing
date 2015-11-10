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

    public function test_encoding()
    {
        $value = new StringValue('fööbär');
        $this->assertEquals('UTF-8', $value->encoding());

        $newValue = $value->convert('ISO-8859-1');
        $this->assertEquals('ISO-8859-1', $newValue->encoding());
        $this->assertEquals(mb_convert_encoding('fööbär', 'ISO-8859-1', 'UTF-8'), $newValue->raw());
    }

    public function test_length()
    {
        $value = new StringValue('fööbär');
        $this->assertEquals(6, $value->length());
    }

    public function test_trim()
    {
        $value = new StringValue(html_entity_decode("\t foo bar&#160;&thinsp;\n"));
        $this->assertEquals('foo bar', $value->trim()->raw());
    }

    public function test_cut()
    {
        $value = new StringValue(html_entity_decode("foo\nbar&#160;baz&thinsp;qux&#8203;↣↣↣↣"));
        $this->assertEquals('fo...', $value->cut(2 + 3)->raw());
        $this->assertEquals('foo...', $value->cut(5 + 3)->raw());
        $this->assertEquals("foo\nbar...", $value->cut(9 + 3)->raw());
        $this->assertEquals(html_entity_decode("foo\nbar&#160;baz..."), $value->cut(13 + 3)->raw());
        $this->assertEquals(html_entity_decode("foo\nbar&#160;baz&thinsp;qux&#8203;..."), $value->cut(17 + 3)->raw());
        $this->assertEquals(html_entity_decode("foo\nbar&#160;baz&thinsp;qux&#8203;↣↣↣↣"), $value->cut(18 + 3)->raw());
    }

    public function test_to_string()
    {
        $value = new StringValue('foobar');
        $this->assertEquals('foobar', $value->__toString());
    }
}
