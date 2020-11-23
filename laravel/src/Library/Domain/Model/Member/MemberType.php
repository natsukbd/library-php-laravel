<?php

declare(strict_types=1);

namespace Library\Domain\Model\Member;

use MyCLabs\Enum\Enum;

/**
 * 会員種別
 * @method static MemberType 大人()
 * @method static MemberType 子供()
 */
final class MemberType extends Enum
{
    private const 大人 = '大人';
    private const 子供 = '子供';
}
