<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan\Rule;

use Library\Domain\Model\Loan\Loans;
use Library\Domain\Model\Member\Member;
use Library\Domain\Type\Date\CurrentDate;

/**
 * 貸出制限
 */
final class Restriction
{
    private Member $member;

    private Loans $loans;

    private CurrentDate $date;

    private RestrictionMap $map;

    /**
     * Restriction constructor.
     * @param Member $member
     * @param Loans $loans
     * @param CurrentDate $date
     */
    private function __construct(Member $member, Loans $loans, CurrentDate $date)
    {
        $this->member = $member;
        $this->loans = $loans;
        $this->date = $date;

        $this->map = new RestrictionMap();
    }

    public static function create(Member $member, Loans $loans, CurrentDate $date): Restriction
    {
        return new static($member, $loans, $date);
    }

    public function ofQuantity(): RestrictionOfQuantity
    {
        $delayStatus = $this->loans->worst($this->date);
        $delayOfMember = DelayOfMember::create($delayStatus, $this->member->type());
        return $this->map->of($delayOfMember);
    }
}
