<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers Mihaeu\ProductConfigurator\OptionName
 */
class OptionNameTest extends \PHPUnit_Framework_TestCase
{
    public function testAcceptsGoodName()
    {
        $optionName = new OptionName('Good');
        $this->assertEquals('Good', $optionName);
    }

    public function testRejectsEmptyName()
    {
        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '/Minimum/');
        $optionName = new OptionName('');
    }

    public function testRejectsNameWhichIsTooShort()
    {
        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '/Minimum/');
        $optionName = new OptionName(str_repeat('.', OptionName::MIN_LENGTH - 1));
    }

    public function testRejectNameWhichIsTooLong()
    {
        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '/Maximum/');
        $optionName = new OptionName(str_repeat('.', OptionName::MAX_LENGTH + 1));
    }
}
