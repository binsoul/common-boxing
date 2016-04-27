<?php

declare (strict_types = 1);

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
    public function __construct(string $value, string $encoding = 'UTF-8')
    {
        $this->value = $value;
        $this->encoding = $encoding;
    }

    /**
     * Returns the wrapped string.
     *
     * @return string
     */
    public function raw()
    {
        return $this->value;
    }

    /**
     * Returns the encoding.
     *
     * @return string
     */
    public function encoding(): string
    {
        return $this->encoding;
    }

    /**
     * Converts the encoding.
     *
     * @param string $encoding
     *
     * @return self
     */
    public function convert(string $encoding): self
    {
        return new self(mb_convert_encoding($this->value, $encoding, $this->encoding), $encoding);
    }

    /**
     * Returns the length of the string.
     *
     * @return int
     */
    public function length(): int
    {
        return mb_strlen($this->value, $this->encoding);
    }

    /**
     * Removes space characters from the beginning and the end.
     *
     * @return self
     */
    public function trim(): self
    {
        return new self(preg_replace('/^[\p{Z}\s]+|[\p{Z}\s]+$/u', '', $this->value), $this->encoding);
    }

    /**
     * Returns a truncated string with the specified length.
     *
     * @param int    $length desired length
     * @param string $marker added to the end if string is truncated
     *
     * @return self
     */
    public function cut(int $length, string $marker = '...'): self
    {
        if (mb_strlen($this->value) < $length) {
            return clone $this;
        }

        $cut = mb_substr($this->value, 0, $length - mb_strlen($marker), $this->encoding);
        $result = preg_replace('/[\p{Z}\s]+$/u', '', trim($cut));

        $words = preg_split('/([\p{Zs}\x{200B}\s]+)/u', $result, -1, PREG_SPLIT_DELIM_CAPTURE);
        if (count($words) > 1) {
            array_pop($words);

            $result = '';
            foreach ($words as $word) {
                $result .= $word;
            }

            $result = preg_replace('/[\p{Z}\s]+$/u', '', $result);
        }

        return new self($result.$marker, $this->encoding);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
