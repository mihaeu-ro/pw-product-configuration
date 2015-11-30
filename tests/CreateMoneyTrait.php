<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

trait CreateMoneyTrait
{
    private function createMoney()
    {
        return new Money(rand(1, 10), new Currency('EUR'));
    }
}
