<?php

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
