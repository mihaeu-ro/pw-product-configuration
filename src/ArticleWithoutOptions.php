<?php declare(strict_types = 1);

class ArticleWithoutOptions extends Article
{
    public function totalPrice() :Money
    {
        return $this->basePrice();
    }
}
