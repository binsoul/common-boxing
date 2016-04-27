<?php

declare (strict_types = 1);

namespace BinSoul\Common\Boxing\Type;

use BinSoul\Common\Boxing\BoxedValue;
use BinSoul\Common\Boxing\ValueWrapper;

/**
 * Represents a lazily generated value.
 */
class LazyValue implements BoxedValue
{
    /** @var int|float */
    private $value;
    /** @var callable */
    private $generator;
    /** @var ValueWrapper */
    private $wrapper;

    /**
     * Constructs an instance of this class.
     *
     * @param callable     $generator
     * @param ValueWrapper $wrapper
     */
    public function __construct(callable $generator, ValueWrapper $wrapper)
    {
        $this->generator = $generator;
        $this->wrapper = $wrapper;
    }

    /**
     * Calls the generator and returns the boxed value.
     *
     * @return BoxedValue
     */
    public function resolve(): BoxedValue
    {
        if ($this->value === null) {
            $generator = $this->generator;
            $this->value = $this->wrapper->box($generator());
        }

        return $this->value;
    }

    /**
     * Calls the generator and returns the primitive value.
     *
     * @return mixed
     */
    public function raw()
    {
        $generator = $this->generator;

        return $generator();
    }

    public function __toString(): string
    {
        return (string) $this->resolve();
    }
}
