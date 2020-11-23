<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan;

use Illuminate\Support\Collection;
use Library\Domain\Model\Loan\Delay\DaysLate;
use Library\Domain\Model\Loan\Delay\DelayStatus;
use Library\Domain\Type\Date\CurrentDate;

/**
 * 貸出のリスト
 */
final class Loans
{
    /**
     * @var Collection
     */
    private Collection $list;

    private function __construct(Collection $list)
    {
        $this->list = $list->map(
            static function (Loan $loan) {
                return $loan;
            }
        );
    }

    public static function from(array $list): Loans
    {
        return new static(Collection::make($list));
    }

    public function worst(CurrentDate $date): DelayStatus
    {
        return $this->worstDays($date)->delayStatus();
    }

    private function worstDays(CurrentDate $date): DaysLate
    {
        $late = $this->list->map(
            static function (Loan $loan) use ($date) {
                return $loan->daysLate($date)->intValue();
            }
        );

        if ($late->isEmpty()) {
            return DaysLate::create(0);
        }
        return DaysLate::create($late->max());
    }

    public function count(): int
    {
        return $this->list->count();
    }
}
