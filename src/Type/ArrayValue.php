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
    private $wrapper;

    /**
     * Constructs an instance of this class.
     *
     * @param mixed[]      $values
     * @param ValueWrapper $wrapper
     */
    public function __construct($values, ValueWrapper $wrapper)
    {
        $this->wrapper = $wrapper;
        $this->values = $values;
        $this->keys = array_keys($values);
    }

    /**
     * Returns the wrapped array.
     *
     * @return mixed[]
     */
    public function raw()
    {
        return $this->values;
    }

    /**
     * Returns all keys.
     *
     * @return self
     */
    public function keys()
    {
        return new self($this->keys, $this->wrapper);
    }

    /**
     * Returns all values.
     *
     * @return self
     */
    public function values()
    {
        return new self(array_values($this->values), $this->wrapper);
    }

    /**
     * Returns the number of entries in the array.
     *
     * @return int
     */
    public function count()
    {
        return count($this->values);
    }

    /**
     * Returns all entries from the beginning of the array up to the given length.
     *
     * @param int $length
     *
     * @return self
     */
    public function limit($length)
    {
        return new self(array_slice($this->values, 0, $length, true), $this->wrapper);
    }

    /**
     * Returns all entries from the given start index to the end of the array.
     *
     * @param $start
     *
     * @return self
     */
    public function offset($start)
    {
        return new self(array_slice($this->values, $start, null, true), $this->wrapper);
    }

    /**
     * Returns a slice of the array from the given start index up to the given length.
     *
     * @param int $start
     * @param int $length
     *
     * @return self
     */
    public function slice($start, $length)
    {
        return new self(array_slice($this->values, $start, $length, true), $this->wrapper);
    }

    /**
     * Returns an array which contains at least the the given number of entries.
     *
     * @param int   $length desired number of entries
     * @param mixed $filler value to use if the array is too short
     *
     * @return self
     */
    public function fill($length, $filler = null)
    {
        $result = $this->values;
        while (count($result) < $length) {
            $result[] = $filler;
        }

        return new self($result, $this->wrapper);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->values);
    }

    public function offsetGet($offset)
    {
        return $this->wrapper->box($this->values[$offset]);
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
