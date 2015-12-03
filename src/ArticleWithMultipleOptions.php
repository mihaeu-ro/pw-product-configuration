<?php declare(strict_types = 1);

namespace Mihaeu\ProductConfigurator;

class ArticleWithMultipleOptions extends Article
{
    const MAX_OPTIONS = 3;
    /**
     * @var OptionCollection
     */
    private $options;

    /**
     * @param ArticleName $name
     * @param Money $basePrice
     * @param Option $option
     */
    public function __construct(ArticleName $name, Money $basePrice, Option $option)
    {
        parent::__construct($name, $basePrice);

        $this->options = new OptionCollection();
        $this->options->addOption($option);
    }

    /**
     * @return Money
     */
    public function totalPrice() :Money
    {
        $price = $this->basePrice();

        foreach ($this->options as $option) {
            $price = $price->addTo($option->price());
        }

        return $price;
    }

    public function addOption($option)
    {
        $this->ensureOptionIsNotAlreadyPresent($option);
        $this->ensureMaximumNumberOfOptionsIsNotExceeded();
        $this->ensureOptionsAreCompatibleWithOtherOptions($option);
        $this->ensureCompatibleWithArticle($option);

        $this->options->addOption($option);
    }

    public function options() : OptionCollection
    {
        return $this->options;
    }

    private function ensureOptionIsNotAlreadyPresent($option)
    {
        if (in_array($option, $this->options->toArray())) {
            throw new \InvalidArgumentException('Option has already been added.');
        }
    }

    private function ensureMaximumNumberOfOptionsIsNotExceeded()
    {
        if (count($this->options) >= self::MAX_OPTIONS) {
            throw new \InvalidArgumentException('Article does not allow for more than three options.');
        }
    }

    private function ensureOptionsAreCompatibleWithOtherOptions(Option $option)
    {
        if (false === $option->isCompatibleWith($this->options)) {
            throw new \InvalidArgumentException(
                'Option '.$option->name().' is not compatible '.
                'with some of the already added options ('.$this->options.')'
            );
        }
    }

    public function __toString() : string
    {
        $output = 'base: '.$this->basePrice();
        for ($i = 0; $i < count($this->options->toArray()); ++$i) {
            $output .= PHP_EOL.'option'.($i + 1).': '.$this->options->toArray()[$i];
        }
        $output .= PHP_EOL.'total: '.$this->totalPrice();
        return $output;
    }
}
