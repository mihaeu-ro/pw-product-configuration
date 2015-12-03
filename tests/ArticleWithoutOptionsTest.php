<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers Mihaeu\ProductConfigurator\ArticleWithoutOptions
 * @covers Mihaeu\ProductConfigurator\Article
 * @uses Mihaeu\ProductConfigurator\Money
 * @uses Mihaeu\ProductConfigurator\Currency
 * @uses Mihaeu\ProductConfigurator\ArticleName
 * @uses Mihaeu\ProductConfigurator\UId
 */
class ArticleWithoutOptionsTest extends \PHPUnit_Framework_TestCase
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
