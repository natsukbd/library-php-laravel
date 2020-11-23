<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan;

/**
 * 貸出番号
 */
final class LoanNumber
{
    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function create(int $value): LoanNumber
    {
        return new static($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
