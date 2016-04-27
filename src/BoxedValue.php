<?php

declare (strict_types = 1);

namespace BinSoul\Common\Boxing;

/**
 * Wraps a primitive type within an object.
 */
interface BoxedValue
{
    /**
     * Returns the wrapped primitive value.
     *
     * @return mixed
     */
    public function raw();
}
