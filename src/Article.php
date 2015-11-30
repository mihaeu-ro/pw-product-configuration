<?php declare(strict_types = 1);

abstract class Article
{
    /**
     * @var Money
     */
    private $basePrice;

    /**
     * @var ArticleName
     */
    private $name;

    /**
     * @var UId
     */
    private $uid;

    /**
     * @param Money $basePrice
     */
    public function __construct(ArticleName $name, Money $basePrice)
    {
        $this->name = $name;
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
