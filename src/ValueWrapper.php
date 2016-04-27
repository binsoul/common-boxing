<?php

declare (strict_types = 1);

namespace BinSoul\Common\Boxing;

/**
 * Creates boxed types.
 */
interface ValueWrapper
{
    /**
     * Builds a boxed type for the given value.
     *
     * @param mixed $value
     *
     * @return BoxedValue
     */
    public function box($value): BoxedValue;
}
