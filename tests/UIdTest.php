<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers UId
 */
class UIdTest extends \PHPUnit_Framework_TestCase
{
    public function testSameArgumentsProduceDifferentIdentifier()
    {
        $uidA = new UId(['test']);
        $uidB = new UId(['test']);
        $this->assertNotSame($uidA, $uidB);
    }
}
