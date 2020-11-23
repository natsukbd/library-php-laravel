<?php

declare(strict_types=1);

namespace Library\Domain\Model\Item\Bibliography;

/**
 * 書籍番号
 */
final class BookNumber
{
    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function create(int $value): BookNumber
    {
        return new static($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
