<?php

/**
 * @covers Option
 * @uses Money
 * @uses Currency
 */
class OptionTest extends PHPUnit_Framework_TestCase
{
    use CreateMoneyTrait;

    public function testPriceCanBeRetrieved()
    {
        $price = $this->createMoney();

        $option = new Option($price);

        $this->assertTrue($price->equals($option->price()));
    }
}
