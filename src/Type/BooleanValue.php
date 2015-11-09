<?php

namespace BinSoul\Common\Boxing\Type;

use BinSoul\Common\Boxing\BoxedValue;

/**
 * Represents a boxed boolean.
 */
class BooleanValue implements BoxedValue
{
    /** @var bool */
    private $value;

    /**
     * Constructs an instance of this class.
     *
     * @param bool $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Returns the wrapped boolean.
     *
     * @return bool
     */
    public function raw()
    {
        return $this->value;
    }

    /**
     * Indicates if the value is true.
     *
     * @return bool
     */
    public function isTrue()
    {
        return $this->value;
    }

    /**
     * Indicates if the value is false.
     *
     * @return bool
     */
    public function isFalse()
    {
        return !$this->value;
    }

    /**
     * Returns a negated value.
     *
     * @return BooleanValue
     */
    public function negate()
    {
        return new self(!$this->value);
    }

    public function __toString()
    {
        return $this->value ? 'true' : 'false';
    }
}
