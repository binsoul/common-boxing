<?php

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
    private $autoBoxer;

    /**
     * Constructs an instance of this class.
     *
     * @param callable     $generator
     * @param ValueWrapper $autoBoxer
     */
    public function __construct(callable $generator, ValueWrapper $autoBoxer)
    {
        $this->generator = $generator;
        $this->autoBoxer = $autoBoxer;
    }

    /**
     * @return BoxedValue
     */
    public function resolve()
    {
        if ($this->value === null) {
            $generator = $this->generator;
            $this->value = $this->autoBoxer->box($generator());
        }

        return $this->value;
    }

    /**
     * @return mixed
     */
    public function raw()
    {
        $generator = $this->generator;

        return $generator();
    }

    public function __toString()
    {
        return (string) $this->resolve();
    }
}
