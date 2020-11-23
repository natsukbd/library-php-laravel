<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan;

use Illuminate\Support\Collection;

/**
 * 貸出のリスト
 * Class Loans
 * @package Library\Domain\Model\Loan
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

    public function from(array $list): Loans
    {
        return new static(Collection::make($list));
    }

    public function count(): int
    {
        return $this->list->count();
    }
}
