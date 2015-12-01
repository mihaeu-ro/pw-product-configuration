<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

class ArticleName
{
    const MIN_LENGTH = 6;
    const MAX_LENGTH = 255;
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        if (strlen($name) < self::MIN_LENGTH) {
            throw new \InvalidArgumentException('Minimum length for article name is 6.');
        }

        if (strlen($name) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException('Maximum length for article name is 255.');
        }

        $this->name = $name;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}