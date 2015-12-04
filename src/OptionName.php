<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

class OptionName
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 255;

    /**
     * @var string
     */
    private $name = '';

    public function __construct(string $name)
    {
        if (strlen($name) < self::MIN_LENGTH) {
            throw new \InvalidArgumentException('Minimum length for an option\'s name is '.self::MIN_LENGTH);
        }

        if (strlen($name) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException('Maximum length for an option\'s name is '.self::MAX_LENGTH);
        }

        $this->name = $name;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
