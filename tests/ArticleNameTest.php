<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

/**
 * @covers ArticleName
 */
class ArticleNameTest extends \PHPUnit_Framework_TestCase
{
    public function testCannotBeEmpty()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        new ArticleName('');
    }

    public function testCannotBeLongerThan255Characters()
    {
        $this->setExpectedException(\InvalidArgumentException::class);
        new ArticleName(str_repeat('.', 256));
    }

    public function testAcceptsNameWith255Characters()
    {
        $name = new ArticleName('stuff');
        $this->assertEquals('stuff', $name);
    }

    public function testConvertsToString()
    {
        $this->assertEquals('test', new ArticleName('test'));
    }
}
