<?php declare(strict_types = 1);

class ArticleWithMultipleOptions extends Article
{
    /**
     * @var Option[]
     */
    private $options = [];

    /**
     * @param Money  $basePrice
     * @param Option $option
     */
    public function __construct(Money $basePrice, Option $option)
    {
        parent::__construct($basePrice);

        $this->options[] = $option;
    }

    /**
     * @return Money
     */
    public function totalPrice() :Money
    {
        $price = $this->basePrice();

        foreach ($this->options as $option) {
            $price = $price->addTo($option->price());
        }

        return $price;
    }

    public function addOption($option)
    {
        $this->ensureOptionIsNotAlreadyPresent($option);
        $this->ensureMaximumNumberOfOptionsIsNotExceeded();

        $this->options[] = $option;
    }

    private function ensureOptionIsNotAlreadyPresent($option)
    {
        // @todo
    }

    private function ensureMaximumNumberOfOptionsIsNotExceeded()
    {
        if (count($this->options) == 2) {
            // @todo
        }
    }
}
