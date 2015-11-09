<?php

namespace BinSoul\Common\Boxing\Type;

use BinSoul\Common\Boxing\BoxedValue;
use BinSoul\Common\Boxing\ValueWrapper;

/**
 * Represents a boxed object.
 */
class ObjectValue implements BoxedValue
{
    /** @var object */
    private $value;
    /** @var ValueWrapper */
    private $autoBoxer;

    /**
     * Constructs an instance of this class.
     *
     * @param object       $value
     * @param ValueWrapper $autoBoxer
     */
    public function __construct($value, ValueWrapper $autoBoxer)
    {
        $this->value = $value;
        $this->autoBoxer = $autoBoxer;
    }

    public function __get($key)
    {
        return $this->autoBoxer->box($this->value->{$key});
    }

    public function __set($key, $value)
    {
        throw new \LogicException('This object is readonly.');
    }

    public function __call($name, $arguments)
    {
        return $this->value->{$name}(...$arguments);
    }

    /**
     * Returns the wrapped object.
     *
     * @return object
     */
    public function raw()
    {
        return $this->value;
    }
}
