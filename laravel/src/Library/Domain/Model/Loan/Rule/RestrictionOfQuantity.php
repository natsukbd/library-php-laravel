<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan\Rule;

use Library\Domain\Model\Loan\Loans;
use MyCLabs\Enum\Enum;

/**
 * 冊数制限(判定結果)
 * @method static RestrictionOfQuantity 貸出5冊まで()
 * @method static RestrictionOfQuantity 貸出7冊まで()
 * @method static RestrictionOfQuantity 貸出4冊まで()
 * @method static RestrictionOfQuantity 貸出不可()
 */
final class RestrictionOfQuantity extends Enum
{
    private const 貸出5冊まで = '貸出5冊まで';
    private const 貸出7冊まで = '貸出7冊まで';
    private const 貸出4冊まで = '貸出4冊まで';
    private const 貸出不可 = '貸出不可';

    public function shouldRestrict(Loans $loans): Loanability
    {
        if ($this->getValue() > $loans->count()) {
            return Loanability::貸出し可能();
        }
        return Loanability::貸出し不可();
    }
}
