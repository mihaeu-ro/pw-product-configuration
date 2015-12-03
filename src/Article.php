<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

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
     * @var OptionCollection
     */
    private $compatibleOptions = [
        'Garantieverlängerungen',
        'Zusatzleistungen'
    ];

    /**
     * @param ArticleName $name
     * @param Money $basePrice
     * @param string[] $compatibleOptions
     */
    public function __construct(ArticleName $name, Money $basePrice, array $compatibleOptions = [])
    {
        $this->name = $name;
        $this->basePrice = $basePrice;
        $this->compatibleOptions += $compatibleOptions;

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

    protected function ensureCompatibleWithArticle(Option $option)
    {
        if (in_array($option->name(), $this->compatibleOptions)) {
            throw new \InvalidArgumentException('Option '.$option.' not compatible with article');
        }
    }
}
