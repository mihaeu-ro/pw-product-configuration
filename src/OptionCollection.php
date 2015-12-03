<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

class OptionCollection implements \IteratorAggregate
{
    /** @var Option[] */
    private $options = [];

    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->options);
    }

    public function addOption(Option $option)
    {
        $this->options[] = $option;
    }
}