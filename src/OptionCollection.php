<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

class OptionCollection implements \IteratorAggregate, \Countable
{
    /**
     * @var Option[]
     */
    private $options = [];

    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->options);
    }

    public function addOption(Option $option)
    {
        $this->options[] = $option;
    }

    public function count() : int
    {
        return count($this->options);
    }

    /**
     * @return Option[]
     */
    public function toArray() : array
    {
        return $this->options;
    }

    public function __toString() : string
    {
        return implode(', ', $this->options);
    }
}