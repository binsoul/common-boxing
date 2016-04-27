<?php

declare (strict_types = 1);

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
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * Returns the wrapped float.
     *
     * @return float
     */
    public function raw()
    {
        return $this->value;
    }

    /**
     * Returns a rounded value with the given number of digits after the decimal point.
     *
     * @param int $precision
     *
     * @return self
     */
    public function round(int $precision)
    {
        return new self(round($this->value, $precision));
    }

    /**
     * Returns the formatted value rounded to the given number of digits after the decimal point.
     *
     * @param int    $precision
     * @param string $decimalPoint
     * @param string $thousandsSeparator
     *
     * @return string
     */
    public function format(int $precision = 0, string $decimalPoint = '.', string $thousandsSeparator = ','): string
    {
        return number_format($this->value, $precision, $decimalPoint, $thousandsSeparator);
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
