<?php

declare(strict_types=1);

namespace Library\Application\Repository;

use Library\Domain\Model\Item\ItemNumber;
use Library\Domain\Model\Loan\Loan;
use Library\Domain\Model\Loan\LoanRequest;

/**
 * 貸出リポジトリ
 */
interface LoanRepository
{
    public function loan(LoanRequest $loanRequest): void;

    public function findBy(ItemNumber $itemNumber): Loan;
}
