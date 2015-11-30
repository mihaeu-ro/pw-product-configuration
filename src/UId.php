<?php declare(strict_types = 1);


class UId
{
    /** @var string */
    private $uid;

    public function __construct(array $args)
    {
        $tmp = '';
        foreach ($args as $arg) {
            $tmp .= $arg;
        }
        $this->uid = sha1($tmp.rand(0, 100).microtime());
    }

    public function __toString() : string
    {
        return $this->uid;
    }
}