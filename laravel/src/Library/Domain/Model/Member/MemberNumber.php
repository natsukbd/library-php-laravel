<?php

declare(strict_types=1);

namespace Library\Domain\Model\Member;

/**
 * 会員番号
 */
final class MemberNumber
{
    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function create(int $value): MemberNumber
    {
        return new static($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
