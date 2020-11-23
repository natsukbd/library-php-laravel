<?php

declare(strict_types=1);

namespace Library\Domain\Model\Item\Bibliography;

/**
 * 本のタイトル
 */
final class Title
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(string $value): Title
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
