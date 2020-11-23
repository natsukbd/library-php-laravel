<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan;

use Illuminate\Support\Carbon;
use Library\Domain\Model\Loan\Delay\DaysLate;

/**
 * 貸出期限
 */
final class DueDate
{
    private const 最大貸出日数 = 14;

    private Carbon $value;

    public function __construct(Carbon $value)
    {
        $this->value = $value;
    }

    public function daysLate(Carbon $判定日): DaysLate
    {
        return DaysLate::create($this->value->diffInDays($判定日));
    }

    public static function create(LoanDate $loanDate): DueDate
    {
        /** @var Carbon $loaned */
        $loaned = Carbon::make($loanDate->value());
        $期限日 = $loaned->addDays(self::最大貸出日数);
        return new static($期限日);
    }
}
