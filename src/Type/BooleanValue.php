<?php

declare (strict_types = 1);

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
    public function __construct(bool $value)
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
    public function isTrue(): bool
    {
        return $this->value;
    }

    /**
     * Indicates if the value is false.
     *
     * @return bool
     */
    public function isFalse(): bool
    {
        return !$this->value;
    }

    /**
     * Returns a negated value.
     *
     * @return self
     */
    public function negate(): self
    {
        return new self(!$this->value);
    }

    public function __toString(): string
    {
        return $this->value ? 'true' : 'false';
    }
}
