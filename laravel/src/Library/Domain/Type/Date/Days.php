<?php

declare(strict_types=1);

namespace Library\Domain\Type\Date;

/**
 * 日数
 */
final class Days
{
    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function create(int $value): Days
    {
        return new static($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function lessThan(int $other): bool
    {
        return $this->value < $other;
    }
}
