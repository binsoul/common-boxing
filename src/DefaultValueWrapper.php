<?php

namespace BinSoul\Common\Boxing;

use BinSoul\Common\Boxing\Type\ArrayValue;
use BinSoul\Common\Boxing\Type\BooleanValue;
use BinSoul\Common\Boxing\Type\LazyValue;
use BinSoul\Common\Boxing\Type\NumberValue;
use BinSoul\Common\Boxing\Type\ObjectValue;
use BinSoul\Common\Boxing\Type\StringValue;

/**
 * Provides a default implementation for the {@see TypeWrapper} interface.
 */
class DefaultValueWrapper implements ValueWrapper
{
    public function box($value)
    {
        if ($value instanceof LazyValue) {
            $value = $value->resolve();
        }

        if ($value instanceof BoxedValue) {
            return $value;
        }

        $result = $value;
        if (is_callable($value)) {
            $result = new LazyValue($value, $this);
        } elseif (is_array($value)) {
            $result = new ArrayValue($value, $this);
        } elseif (is_object($value)) {
            $result = new ObjectValue($value, $this);
        } elseif (is_string($value)) {
            $result = new StringValue($value);
        } elseif (is_int($value) || is_float($value)) {
            $result = new NumberValue($value);
        } elseif (is_bool($value)) {
            $result = new BooleanValue($value);
        }

        return $result;
    }
}
