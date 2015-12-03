<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers Mihaeu\ProductConfigurator\OptionCollection
 */
class OptionCollectionTest extends \PHPUnit_Framework_TestCase
{
    private $option1;
    private $option2;
    private $collection;

    public function setUp()
    {
        $this->option1 = $this->getMockBuilder(Option::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->option1->method('__toString')->willReturn('1');
        $this->option2 = $this->getMockBuilder(Option::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->option2->method('__toString')->willReturn('2');
        $this->collection = new OptionCollection();
        $this->collection->addOption($this->option1);
        $this->collection->addOption($this->option2);
    }

    public function testLoopsOverOptions()
    {
        foreach ($this->collection as $option) {
            // the element should be one of the two we added
            $this->assertTrue($option === $this->option1 || $option === $this->option2);
        }
    }

    public function testConvertsToArray()
    {
        $this->assertCount(2, $this->collection->toArray());
    }

    public function testConvertsToString()
    {
        $this->assertEquals('1, 2', $this->collection->__toString());
    }

    public function testCountsMembers()
    {
        $this->assertCount(2, $this->collection);
    }
}
