<?php

/**
 * @covers ArticleWithoutOptions
 * @covers Article
 * @uses Money
 * @uses Currency
 */
class ArticleWithoutOptionsTest extends PHPUnit_Framework_TestCase
{
    public function testTotalPriceCanBeRetrieved()
    {
        $price = new Money(1, new Currency('EUR'));

        $article = new ArticleWithoutOptions($price);

        $this->assertSame($price, $article->totalPrice());
    }
}
