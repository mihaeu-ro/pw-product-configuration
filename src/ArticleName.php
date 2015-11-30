<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

class ArticleName
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Article name cannot be empty.');
        }

        if (strlen($name) > 255) {
            throw new \InvalidArgumentException('Maximum length for article name is 255.');
        }

        $this->name = $name;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}