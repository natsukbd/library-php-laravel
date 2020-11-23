<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan\Rule;

use Illuminate\Support\Collection;
use Library\Domain\Model\Loan\Delay\DelayStatus;
use Library\Domain\Model\Member\MemberType;

/**
 * 貸出制限の表条件
 */
final class RestrictionMap
{
    /**
     * @var Collection
     */
    private Collection $map;

    /**
     * RestrictionMap constructor.
     */
    public function __construct()
    {
        $this->map = Collection::make();

        $this->define(DelayStatus::遅延日数3日未満(), MemberType::大人(), RestrictionOfQuantity::貸出5冊まで());
        $this->define(DelayStatus::遅延日数3日未満(), MemberType::子供(), RestrictionOfQuantity::貸出7冊まで());

        $this->define(DelayStatus::遅延日数7日未満(), MemberType::大人(), RestrictionOfQuantity::貸出不可());
        $this->define(DelayStatus::遅延日数7日未満(), MemberType::子供(), RestrictionOfQuantity::貸出4冊まで());

        $this->define(DelayStatus::それ以外(), MemberType::大人(), RestrictionOfQuantity::貸出不可());
        $this->define(DelayStatus::それ以外(), MemberType::子供(), RestrictionOfQuantity::貸出不可());
    }

    public function define(
        DelayStatus $delayStatus,
        MemberType $memberType,
        RestrictionOfQuantity $restrictionOfQuantity
    ): void {
        $delayOfMember = DelayOfMember::create($delayStatus, $memberType);

        $this->map->add(
            [
                DelayOfMember::class => $delayOfMember,
                RestrictionOfQuantity::class => $restrictionOfQuantity
            ]
        );
    }

    public function of(DelayOfMember $delayOfMember): RestrictionOfQuantity
    {
        return $this->map->filter(
            static function (array $item) use ($delayOfMember) {
                return $delayOfMember->equals($item[DelayOfMember::class]);
            }
        )->first()[RestrictionOfQuantity::class];
    }
}
