<?php

/**
 * @covers ArticleWithoutOptions
 * @covers Article
 * @uses Money
 * @uses Currency
 * @uses ArticleName
 * @uses UId
 */
class ArticleWithoutOptionsTest extends PHPUnit_Framework_TestCase
{
    public function testTotalPriceCanBeRetrieved()
    {
        $price = new Money(1, new Currency('EUR'));
        $article = new ArticleWithoutOptions(new ArticleName('Test Article'), $price);

        $this->assertSame($price, $article->totalPrice());
    }

    public function testPrintsDetails()
    {
        $price = new Money(1, new Currency('EUR'));
        $article = new ArticleWithoutOptions(new ArticleName('Test Article'), $price);
        $this->assertEquals('base: 1EUR'.PHP_EOL.'total: 1EUR', $article->__toString());
    }
}
