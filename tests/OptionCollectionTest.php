<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers OptionCollection
 */
class OptionCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testLoopsOverOptions()
    {
        $option1 = $this->getMockBuilder(Option::class)
            ->disableOriginalConstructor()
            ->getMock();
        $option2 = $this->getMockBuilder(Option::class)
            ->disableOriginalConstructor()
            ->getMock();
        $collection = new OptionCollection();
        $collection->addOption($option1);
        $collection->addOption($option2);
        foreach ($collection as $option) {
            // the element should be one of the two we added
            $this->assertTrue($option === $option1 || $option === $option2);
        }
    }
}
