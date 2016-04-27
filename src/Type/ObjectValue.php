<?php

declare (strict_types = 1);

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
    private $wrapper;

    /**
     * Constructs an instance of this class.
     *
     * @param object       $value
     * @param ValueWrapper $wrapper
     */
    public function __construct($value, ValueWrapper $wrapper)
    {
        $this->value = $value;
        $this->wrapper = $wrapper;
    }

    public function __get(string $key)
    {
        return $this->wrapper->box($this->value->{$key});
    }

    public function __set(string $key, $value)
    {
        throw new \LogicException('This object is readonly.');
    }

    public function __isset(string $key): bool
    {
        return isset($this->value->{$key});
    }

    public function __unset(string $key)
    {
        throw new \LogicException('This object is readonly.');
    }

    public function __call(string $name, array $arguments)
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
