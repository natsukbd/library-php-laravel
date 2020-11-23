<?php

declare(strict_types=1);

namespace Library\Infrastructure\InMemory\Loan;

use Library\Application\Repository\LoanRepository;
use Library\Domain\Model\Item\Item;
use Library\Domain\Model\Item\ItemNumber;
use Library\Domain\Model\Loan\Loan;
use Library\Domain\Model\Loan\LoanNumber;
use Library\Domain\Model\Loan\LoanRequest;
use Library\Domain\Model\Member\Member;

/**
 * 貸出リポジトリ
 */
final class InMemoryLoanRepository implements LoanRepository
{
    private array $loan = [];
    private array $member = [];
    private array $item = [];

    public function loan(LoanRequest $loanRequest): void
    {
        $loanNumber = LoanNumber::create(count($this->loan) + 1);
        $member = $this->member[$loanRequest->memberNumber()->value()];
        /** @var Item $item */
        $item = $this->item[$loanRequest->itemNumber()->value()];
        $this->loan[$item->itemNumber()->value()] = Loan::create($loanNumber, $member, $item, $loanRequest->loanDate());
    }

    public function findBy(ItemNumber $itemNumber): Loan
    {
        return $this->loan[$itemNumber->value()];
    }

    public function addMember(Member $member): void
    {
        $this->member[$member->number()->value()] = $member;
    }

    public function addItem(Item $item): void
    {
        $this->item[$item->itemNumber()->value()] = $item;
    }
}
