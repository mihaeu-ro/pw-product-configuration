<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers Mihaeu\ProductConfigurator\ArticleName
 */
class ArticleNameTest extends \PHPUnit_Framework_TestCase
{
    public function testCannotBeEmpty()
    {
        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '/Minimum/');
        new ArticleName('');
    }

    public function testCannotBeShorterThan6Characters()
    {
        $this->setExpectedExceptionRegExp(\InvalidArgumentException::class, '/Minimum/');
        new ArticleName('short');
    }

    public function testCannotBeLongerThan255Characters()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        new ArticleName(str_repeat('.', 256));
    }

    public function testAcceptsNameWith255Characters()
    {
        $name = new ArticleName('stuffffff');
        $this->assertEquals('stuffffff', $name);
    }

    public function testConvertsToString()
    {
        $this->assertEquals('testttt', new ArticleName('testttt'));
    }
}
