<?php

declare(strict_types=1);

namespace Library\Application\Service\Loan;

use Library\Application\Repository\LoanRepository;
use Library\Domain\Model\Loan\LoanRequest;

/**
 * 貸出記録サービス
 */
final class LoanRecordService
{
    private LoanRepository $loanRepository;

    public function __construct(LoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    /**
     * 貸出を記録する
     * @param LoanRequest $loanRequest
     */
    public function loaned(LoanRequest $loanRequest): void
    {
        $this->loanRepository->loan($loanRequest);
    }
}
