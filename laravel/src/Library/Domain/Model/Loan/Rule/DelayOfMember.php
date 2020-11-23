<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan\Rule;

use Library\Domain\Model\Loan\Delay\DelayStatus;
use Library\Domain\Model\Member\MemberType;

/**
 * 遅延状況と会員種別（判定条件）
 */
final class DelayOfMember
{
    private DelayStatus $delayStatus;

    private MemberType $memberType;

    private function __construct(DelayStatus $delayStatus, MemberType $memberType)
    {
        $this->delayStatus = $delayStatus;
        $this->memberType = $memberType;
    }

    public static function create(DelayStatus $delayStatus, MemberType $memberType): DelayOfMember
    {
        return new static($delayStatus, $memberType);
    }

    public function equals(DelayOfMember $other): bool
    {
        return $this->delayStatus->equals($other->delayStatus) &&
            $this->memberType->equals($other->memberType);
    }
}
