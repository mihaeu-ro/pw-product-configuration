<?php

/**
 * @covers ArticleWithMultipleOptions
 * @covers Article
 * @uses Money
 * @uses Currency
 * @uses ArticleName
 * @uses UId
 */
class ArticleWithMultipleOptionsTest extends PHPUnit_Framework_TestCase
{
    use CreateMoneyTrait;

    public function testBasePriceCanBeRetrieved()
    {
        $price = $this->createMoney();
        $article = new ArticleWithMultipleOptions(new ArticleName('Test Article'), $price, $this->createOption());

        $this->assertTrue($price->equals($article->basePrice()));
    }

    /*
    public function testOptionCanBeSet()
    {
        $price = new Money(1, new Currency('EUR'));

        $option = $this->createOption();

        $article = new ArticleWithOneOption($price);
        $article->setOption($option);

        $this->assertSame($option, $article->getOption());
    }
    */

    public function testTotalPriceWithOneOptionCanBeRetrieved()
    {
        $optionPrice = $this->createMoney();
        $basePrice = $this->createMoney();

        $option = $this->createOption();
        $option->method('price')->willReturn($optionPrice);

        $article = new ArticleWithMultipleOptions(new ArticleName('Test Article'), $basePrice, $option);

        $this->assertTrue($basePrice->addTo($optionPrice)->equals($article->totalPrice()));
    }

    public function testTotalPriceWithTwoOptionsCanBeRetrieved()
    {
        $optionPrice1 = $this->createMoney();
        $optionPrice2 = $this->createMoney();
        $basePrice = $this->createMoney();

        $option1 = $this->createOption();
        $option1->method('price')->willReturn($optionPrice1);

        $option2 = $this->createOption();
        $option2->method('price')->willReturn($optionPrice2);

        $article = new ArticleWithMultipleOptions(new ArticleName('Test Article'), $basePrice, $option1);
        $article->addOption($option2);

        $this->assertTrue($basePrice->addTo($optionPrice1)->addTo($optionPrice2)->equals($article->totalPrice()));
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
