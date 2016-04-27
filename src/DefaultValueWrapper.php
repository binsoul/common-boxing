<?php

declare (strict_types = 1);

namespace BinSoul\Common\Boxing;

use BinSoul\Common\Boxing\Type\ArrayValue;
use BinSoul\Common\Boxing\Type\BooleanValue;
use BinSoul\Common\Boxing\Type\LazyValue;
use BinSoul\Common\Boxing\Type\NullValue;
use BinSoul\Common\Boxing\Type\NumberValue;
use BinSoul\Common\Boxing\Type\ObjectValue;
use BinSoul\Common\Boxing\Type\StringValue;

/**
 * Provides a default implementation for the {@see TypeWrapper} interface.
 */
class DefaultValueWrapper implements ValueWrapper
{
    public function box($value): BoxedValue
    {
        if ($value instanceof LazyValue) {
            $value = $value->resolve();
        }

        if ($value instanceof BoxedValue) {
            return $value;
        }

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
        } elseif (is_null($value)) {
            $result = new NullValue($value);
        } else {
            throw new \InvalidArgumentException(sprintf('Cannot box value of type "%s".', gettype($value)));
        }

        return $result;
    }
}
