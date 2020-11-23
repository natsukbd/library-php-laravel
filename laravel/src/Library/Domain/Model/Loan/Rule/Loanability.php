<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan\Rule;

use MyCLabs\Enum\Enum;

/**
 * 貸出可否
 * @method static Loanability 貸出し不可()
 * @method static Loanability 貸出し可能()
 */
final class Loanability extends Enum
{
    private const 貸出し不可 = 'これ以上本を貸し出すことができません。';
    private const 貸出し可能 = '';

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->getValue();
    }
}
