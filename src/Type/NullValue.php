<?php

declare (strict_types = 1);

namespace BinSoul\Common\Boxing\Type;

use BinSoul\Common\Boxing\BoxedValue;

/**
 * Represents a boxed null value.
 */
class NullValue implements BoxedValue
{
    /**
     * @return null
     */
    public function raw()
    {
        return null;
    }

    public function __toString(): string
    {
        return '';
    }
}
