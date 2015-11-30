<?php

/**
 * @covers ArticleWithOneOption
 * @covers Article
 * @uses Money
 * @uses Currency
 * @uses ArticleName
 * @uses UId
 */
class ArticleWithOneOptionTest extends PHPUnit_Framework_TestCase
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
     * @return PHPUnit_Framework_MockObject_MockObject|Option
     */
    private function createOption()
    {
        return $this->getMockBuilder(Option::class)
                       ->disableOriginalConstructor()
                       ->getMock();
    }
}
