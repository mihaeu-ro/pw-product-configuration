<?php declare(strict_types = 1);

/**
 * @covers UId
 */
class UIdTest extends PHPUnit_Framework_TestCase
{
    public function testSameArgumentsProduceDifferentIdentifier()
    {
        $uidA = new UId(['test']);
        $uidB = new UId(['test']);
        $this->assertNotEquals($uidA->uid(), $uidB->uid());
    }
    
    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}