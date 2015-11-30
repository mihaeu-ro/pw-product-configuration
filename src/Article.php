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
     * @param ArticleName $name
     * @param Money $basePrice
     */
    public function __construct(ArticleName $name, Money $basePrice)
    {
        $this->name = $name;
        $this->basePrice = $basePrice;

        $this->uid = new UId([$name, $basePrice]);
    }

    /**
     * @codeCoverageIgnore
     *
     * @return UId
     */
    public function uid() : UId
    {
        return $this->uid;
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

    /**
     * @return string
     */
    abstract public function __toString() : string;
}
