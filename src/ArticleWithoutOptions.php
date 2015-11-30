<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

class ArticleWithoutOptions extends Article
{
    public function totalPrice() :Money
    {
        return $this->basePrice();
    }

    public function __toString() : string
    {
        return 'base: '.$this->basePrice().PHP_EOL
            .'total: '.$this->totalPrice();
    }
}
