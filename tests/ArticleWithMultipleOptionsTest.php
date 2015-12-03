<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers Mihaeu\ProductConfigurator\ArticleWithMultipleOptions
 * @covers Mihaeu\ProductConfigurator\Article
 * @uses Mihaeu\ProductConfigurator\Money
 * @uses Mihaeu\ProductConfigurator\Currency
 * @uses Mihaeu\ProductConfigurator\ArticleName
 * @uses Mihaeu\ProductConfigurator\UId
 * @uses Mihaeu\ProductConfigurator\OptionCollection
 */
class ArticleWithMultipleOptionsTest extends \PHPUnit_Framework_TestCase
{
    use CreateMoneyTrait;

    public function testBasePriceCanBeRetrieved()
    {
        $price = $this->createMoney();
        $article = new ArticleWithMultipleOptions(new ArticleName('Test Article'), $price, $this->createOption());

        $this->assertTrue($price->equals($article->basePrice()));
    }

    public function testOptionCanBeSet()
    {
        $price = new Money(1, new Currency('EUR'));

        $option = $this->createOption();

        $article = new ArticleWithMultipleOptions(new ArticleName('Test Article'), $price, $option);
        $this->assertSame($option, $article->options()->toArray()[0]);
    }

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

    public function testPrintsDetails()
    {
        $optionPrice1 = new Money(1, new Currency('EUR'));
        $optionPrice2 = new Money(2, new Currency('EUR'));
        $basePrice = new Money(1, new Currency('EUR'));

        $option1 = $this->createOption();
        $option1->method('price')->willReturn($optionPrice1);
        $option1->method('__toString')->willReturn($optionPrice1);

        $option2 = $this->createOption();
        $option2->method('price')->willReturn($optionPrice2);
        $option2->method('__toString')->willReturn($optionPrice2);

        $article = new ArticleWithMultipleOptions(new ArticleName('Test Article'), $basePrice, $option1);
        $article->addOption($option2);
        $this->assertEquals('base: 1EUR'.PHP_EOL
            .'option1: 1EUR'.PHP_EOL
            .'option2: 2EUR'.PHP_EOL
            .'total: 4EUR',
            $article->__toString()
        );
    }

    public function testDoesNotAcceptMoreThanThreeOptions()
    {
        $option1 = $this->createOption();
        $option1->method('price')->willReturn(new Money(1, new Currency('EUR')));
        $option2 = $this->createOption();
        $option2->method('price')->willReturn(new Money(2, new Currency('EUR')));
        $option3 = $this->createOption();
        $option3->method('price')->willReturn(new Money(3, new Currency('EUR')));
        $option4 = $this->createOption();
        $option4->method('price')->willReturn(new Money(4, new Currency('EUR')));
        $article = new ArticleWithMultipleOptions(
            new ArticleName('Test Article'),
            new Money(1, new Currency('EUR')),
            $option1
        );

        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '/Article does not .*/');
        $article->addOption($option2);
        $article->addOption($option3);
        $article->addOption($option4);
    }

    public function testDoesNotAllowSameOptionTwice()
    {
        $option = $this->createOption();
        $article = new ArticleWithMultipleOptions(
            new ArticleName('Test Article'),
            new Money(1, new Currency('EUR')),
            $option
        );

        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '/Option has already been added./');
        $article->addOption($option);
    }

    public function testDetectsWhenOptionsAreNotCompatible()
    {
        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '/Option.*is not compatible/');

        $option = $this->createOption();
        $article = new ArticleWithMultipleOptions(
            new ArticleName('Test Article'),
            new Money(1, new Currency('EUR')),
            $option
        );
        $option2 = $this->getMockBuilder(Option::class)
            ->disableOriginalConstructor()
            ->getMock();
        $option2->method('isCompatibleWith')->willReturn(false);
        $article->addOption($option2);
    }

    public function testDetectsWhenOptionNotCompatibleWithArticle()
    {
        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '/Option.*not compatible/');
        $option = $this->getMockBuilder(Option::class)->disableOriginalConstructor()->getMock();
        $option->method('name')->willReturn('bad');
        $article = new ArticleWithMultipleOptions(
            new ArticleName('Test Article'),
            new Money(1, new Currency('EUR')),
            $option
        );
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
        $optionMock->method('isCompatibleWith')->willReturn(true);
        return $optionMock;
    }
}
