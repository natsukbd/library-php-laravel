<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan;

use Illuminate\Support\Carbon;
use Library\Domain\Exception\DateFormatException;
use Library\Domain\Model\Item\Item;
use Library\Domain\Model\Loan\Delay\DaysLate;
use Library\Domain\Model\Member\Member;
use Library\Domain\Type\Date\CurrentDate;

/**
 * 貸出
 */
final class Loan
{
    private ?LoanNumber $loanNumber;

    private Member $member;

    private ?Item $item;

    private LoanDate $loanDate;

    private function __construct(?LoanNumber $loanNumber, Member $member, ?Item $item, LoanDate $loanDate)
    {
        $this->loanNumber = $loanNumber;
        $this->member = $member;
        $this->item = $item;
        $this->loanDate = $loanDate;
    }

    public static function create(?LoanNumber $loanNumber, Member $member, ?Item $item, LoanDate $loanDate): Loan
    {
        return new static($loanNumber, $member, $item, $loanDate);
    }

    /**
     * @param CurrentDate $date
     * @return DaysLate
     * @throws DateFormatException
     */
    public function daysLate(CurrentDate $date): DaysLate
    {
        $dueDate = DueDate::create($this->loanDate);
        $判定日 = Carbon::make($date->value());
        if ($判定日 === null) {
            throw new DateFormatException('フォーマットが不正です');
        }
        return $dueDate->daysLate($判定日);
    }

    public function member(): Member
    {
        return $this->member;
    }

    public function date(): LoanDate
    {
        return $this->loanDate;
    }
}
