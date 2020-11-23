<?php

declare(strict_types=1);

namespace Library\Domain\Model\Member;

/**
 * 会員
 */
final class Member
{
    private MemberNumber $memberNumber;

    private Name $name;

    private MemberType $memberType;

    private function __construct(MemberNumber $memberNumber, Name $name, MemberType $memberType)
    {
        $this->memberNumber = $memberNumber;
        $this->name = $name;
        $this->memberType = $memberType;
    }

    public static function create(MemberNumber $memberNumber, Name $name, MemberType $memberType): Member
    {
        return new static($memberNumber, $name, $memberType);
    }

    public function number(): MemberNumber
    {
        return $this->memberNumber;
    }

    public function type(): MemberType
    {
        return $this->memberType;
    }
}
