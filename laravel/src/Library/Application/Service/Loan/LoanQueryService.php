<?php

declare(strict_types=1);

namespace Library\Application\Service\Loan;

use Library\Application\Repository\LoanRepository;
use Library\Domain\Model\Item\ItemNumber;
use Library\Domain\Model\Loan\Loan;

/**
 * 貸出参照サービス
 */
final class LoanQueryService
{
    private LoanRepository $loanRepository;

    public function __construct(LoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    /**
     * 貸出を見つける
     */
    public function findBy(ItemNumber $itemNumber): Loan
    {
        return $this->loanRepository->findBy($itemNumber);
    }
}
