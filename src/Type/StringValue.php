<?php

namespace BinSoul\Common\Boxing\Type;

use BinSoul\Common\Boxing\BoxedValue;

/**
 * Represents a boxed string.
 */
class StringValue implements BoxedValue
{
    /** @var string */
    private $value;
    /** @var string */
    private $encoding;

    /**
     * Constructs an instance of this class.
     *
     * @param string $value
     * @param string $encoding
     */
    public function __construct($value, $encoding = 'UTF-8')
    {
        $this->value = $value;
        $this->encoding = $encoding;
    }

    /**
     * @return string
     */
    public function raw()
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function length()
    {
        return mb_strlen($this->value, $this->encoding);
    }

    public function __toString()
    {
        return $this->value;
    }
}
