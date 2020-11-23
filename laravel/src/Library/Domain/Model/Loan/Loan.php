<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan;

use Library\Domain\Model\Item\Item;
use Library\Domain\Model\Member\Member;

/**
 * 貸出
 */
final class Loan
{
    private LoanNumber $loanNumber;

    private Member $member;

    private Item $item;

    private LoanDate $loanDate;

    private function __construct(LoanNumber $loanNumber, Member $member, Item $item, LoanDate $loanDate)
    {
        $this->loanNumber = $loanNumber;
        $this->member = $member;
        $this->item = $item;
        $this->loanDate = $loanDate;
    }

    public static function create(LoanNumber $loanNumber, Member $member, Item $item, LoanDate $loanDate): Loan
    {
        return new static($loanNumber, $member, $item, $loanDate);
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
