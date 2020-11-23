<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan;

use Library\Domain\Model\Item\ItemNumber;
use Library\Domain\Model\Member\MemberNumber;

/**
 * 貸出依頼
 */
final class LoanRequest
{
    private MemberNumber $memberNumber;

    private ItemNumber $itemNumber;

    private LoanDate $loanDate;

    private function __construct(MemberNumber $memberNumber, ItemNumber $itemNumber, LoanDate $loanDate)
    {
        $this->memberNumber = $memberNumber;
        $this->itemNumber = $itemNumber;
        $this->loanDate = $loanDate;
    }

    public static function create(MemberNumber $memberNumber, ItemNumber $itemNumber, LoanDate $loanDate): LoanRequest
    {
        return new static($memberNumber, $itemNumber, $loanDate);
    }

    public function memberNumber(): MemberNumber
    {
        return $this->memberNumber;
    }

    public function itemNumber(): ItemNumber
    {
        return $this->itemNumber;
    }

    public function loanDate(): LoanDate
    {
        return $this->loanDate;
    }
}
