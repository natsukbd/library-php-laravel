<?php

declare(strict_types=1);

namespace Library\Domain\Model\Member;

/**
 * 名前
 */
final class Name
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(string $value): Name
    {
        return new static($value);
    }
}
