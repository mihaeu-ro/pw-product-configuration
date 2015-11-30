<?php declare(strict_types = 1);

abstract class Article
{
    /**
     * @var Money
     */
    private $basePrice;

    /**
     * @param Money $basePrice
     */
    public function __construct(Money $basePrice)
    {
        $this->basePrice = $basePrice;
    }

    /**
     * @return Money
     */
    public function basePrice() :Money
    {
        return $this->basePrice;
    }

    /**
     * @return Money
     */
    abstract public function totalPrice() :Money;
}
