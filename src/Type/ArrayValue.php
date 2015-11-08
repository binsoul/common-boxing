<?php

namespace BinSoul\Common\Boxing\Type;

use BinSoul\Common\Boxing\BoxedValue;
use BinSoul\Common\Boxing\ValueWrapper;

/**
 * Represents a boxed array.
 */
class ArrayValue implements BoxedValue, \ArrayAccess, \Countable, \Iterator
{
    /** @var int */
    private $index = 0;
    /** @var string[]|int[] */
    private $keys;
    /** @var mixed[] */
    private $values;
    /** @var ValueWrapper */
    private $autoBoxer;

    /**
     * Constructs an instance of this class.
     *
     * @param mixed[]      $values
     * @param ValueWrapper $autoBoxer
     */
    public function __construct($values, ValueWrapper $autoBoxer)
    {
        $this->autoBoxer = $autoBoxer;
        $this->values = $values;
        $this->keys = array_keys($values);
    }

    /**
     * @return mixed[]
     */
    public function raw()
    {
        return $this->values;
    }

    /**
     * @return ArrayValue
     */
    public function keys()
    {
        return new self($this->keys, $this->autoBoxer);
    }

    /**
     * @return ArrayValue
     */
    public function values()
    {
        return new self(array_values($this->values), $this->autoBoxer);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->values);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->values);
    }

    public function offsetGet($offset)
    {
        return $this->autoBoxer->box($this->values[$offset]);
    }

    public function offsetSet($offset, $value)
    {
        throw new \LogicException('This array is readonly.');
    }

    public function offsetUnset($offset)
    {
        throw new \LogicException('This array is readonly.');
    }

    public function rewind()
    {
        $this->index = 0;
    }

    public function current()
    {
        return $this->offsetGet($this->keys[$this->index]);
    }

    public function key()
    {
        return $this->keys[$this->index];
    }

    public function next()
    {
        ++$this->index;
    }

    public function valid()
    {
        return isset($this->keys[$this->index]);
    }
}
