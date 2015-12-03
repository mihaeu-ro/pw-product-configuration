<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers Option
 * @uses Money
 * @uses Currency
 * @uses OptionCollection
 */
class OptionTest extends \PHPUnit_Framework_TestCase
{
    use CreateMoneyTrait;

    public function testPriceCanBeRetrieved()
    {
        $price = $this->createMoney();

        $option = new Option(new OptionName('test'), $price);

        $this->assertTrue($price->equals($option->price()));
    }

    public function testPrintsPrice()
    {
        $price = $this->createMoney();
        $option = new Option(new OptionName('test'), $price);
        $this->assertEquals($price->__toString(), $option->__toString());
    }

    public function testDoesNotAcceptIncompatibleOptions()
    {
        $incompatibleOptions = new OptionCollection();
        $incompatibleOptions->addOption(new Option(new OptionName('test1'), $this->createMoney()));
        $option = new Option(new OptionName('test'), $this->createMoney(), $incompatibleOptions);

        $options = new OptionCollection();
        $options->addOption(new Option(new OptionName('test1'), $this->createMoney()));
        $options->addOption(new Option(new OptionName('test2'), $this->createMoney()));
        $this->assertFalse($option->isCompatibleWith($options));
    }

    public function testChecksForCompatibleOptions()
    {
        $incompatibleOptions = new OptionCollection();
        $incompatibleOptions->addOption(new Option(new OptionName('someOtherOption'), $this->createMoney()));
        $option = new Option(new OptionName('test'), $this->createMoney(), $incompatibleOptions);

        $options = new OptionCollection();
        $options->addOption(new Option(new OptionName('test1'), $this->createMoney()));
        $this->assertTrue($option->isCompatibleWith($options));
    }
}
