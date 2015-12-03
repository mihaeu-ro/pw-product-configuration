<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers Mihaeu\ProductConfigurator\ArticleWithOneOption
 * @covers Mihaeu\ProductConfigurator\Article
 * @uses Mihaeu\ProductConfigurator\Money
 * @uses Mihaeu\ProductConfigurator\Currency
 * @uses Mihaeu\ProductConfigurator\ArticleName
 * @uses Mihaeu\ProductConfigurator\UId
 */
class ArticleWithOneOptionTest extends \PHPUnit_Framework_TestCase
{
    use CreateMoneyTrait;

    public function testBasePriceCanBeRetrieved()
    {
        $price = new Money(1, new Currency('EUR'));
        $article = new ArticleWithOneOption(new ArticleName('Test Article'), $price);

        $this->assertTrue($price->equals($article->basePrice()));
    }

    public function testOptionCanBeSet()
    {
        $price = new Money(1, new Currency('EUR'));

        $option = $this->createOption();

        $article = new ArticleWithOneOption(new ArticleName('Test Article'), $price);
        $article->setOption($option);

        $this->assertSame($option, $article->getOption());
    }

    public function testTotalPriceWithOptionCanBeRetrieved()
    {
        $optionPrice = $this->createMoney();
        $basePrice = $this->createMoney();

        $option = $this->createOption();
        $option->method('price')->willReturn($optionPrice);

        $article = new ArticleWithOneOption(new ArticleName('Test Article'), $basePrice);
        $article->setOption($option);

        $this->assertTrue($basePrice->addTo($optionPrice)->equals($article->totalPrice()));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Option
     */
    private function createOption()
    {
        $optionMock = $this->getMockBuilder(Option::class)
                       ->disableOriginalConstructor()
                       ->getMock();
        $optionMock->method('name')->willReturn('Zusatzleistungen');
        return $optionMock;
    }

    public function testPrintsDetails()
    {
        $optionPrice = new Money(2, new Currency('EUR'));
        $basePrice = new Money(5, new Currency('EUR'));

        $option = $this->createOption();
        $option->method('price')->willReturn($optionPrice);
        $option->method('__toString')->willReturn($optionPrice);

        $article = new ArticleWithOneOption(new ArticleName('Test Article'), $basePrice);
        $article->setOption($option);

        $this->assertEquals('base: 5EUR'.PHP_EOL.'option: 2EUR'.PHP_EOL.'total: 7EUR', $article->__toString());
    }
}
