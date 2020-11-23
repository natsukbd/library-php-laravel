<?php

declare(strict_types=1);

namespace Library\Domain\Model\Item;

/**
 * 蔵書番号
 */
final class ItemNumber
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(string $value): ItemNumber
    {
        return new static($value);
    }

    public static function empty(): ItemNumber
    {
        return new ItemNumber('');
    }

    public function value(): string
    {
        return $this->value;
    }
}
