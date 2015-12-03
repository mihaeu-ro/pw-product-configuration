<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

class ArticleWithOneOption extends Article
{
    /**
     * @var Option
     */
    private $option;

    /**
     * @param Option $option
     */
    public function setOption(Option $option)
    {
        $this->ensureCompatibleWithArticle($option);
        $this->option = $option;
    }

    /**
     * @return Option
     */
    public function getOption() :Option
    {
        return $this->option;
    }

    /**
     * @return Money
     */
    public function totalPrice() :Money
    {
        return $this->basePrice()->addTo($this->option->price());
    }

    public function __toString() : string
    {
        return 'base: '.$this->basePrice().PHP_EOL.
            'option: '.$this->getOption()->__toString().PHP_EOL.
            'total: '.$this->totalPrice();
    }
}
