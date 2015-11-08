<?php

namespace BinSoul\Common\Boxing\Type;

use BinSoul\Common\Boxing\BoxedValue;

/**
 * Represents a boxed float.
 */
class NumberValue implements BoxedValue
{
    /** @var float */
    private $value;

    /**
     * Constructs an instance of this class.
     *
     * @param float|int $value
     */
    public function __construct($value)
    {
        $this->value = (float) $value;
    }

    /**
     * @return float|int
     */
    public function raw()
    {
        return $this->value;
    }

    /**
     * @param int $precision
     *
     * @return NumberValue
     */
    public function round($precision)
    {
        return new self(round($this->value, $precision));
    }

    public function format($decimals = 0, $decimalPoint = '.', $thousandsSeparator = ',')
    {
        return number_format($this->value, $decimals, $decimalPoint, $thousandsSeparator);
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
