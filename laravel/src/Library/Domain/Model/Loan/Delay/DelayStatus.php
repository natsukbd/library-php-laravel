<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan\Delay;

use Library\Domain\Type\Date\Days;
use MyCLabs\Enum\Enum;

/**
 * 遅延状態
 * @method static DelayStatus 遅延日数3日未満()
 * @method static DelayStatus 遅延日数7日未満()
 * @method static DelayStatus それ以外()
 */
final class DelayStatus extends Enum
{
    private const 遅延日数3日未満 = '遅延日数3日未満';
    private const 遅延日数7日未満 = '遅延日数7日未満';
    private const それ以外 = 'それ以外';

    public static function level(Days $days): DelayStatus
    {
        if ($days->lessThan(3)) {
            return new static(self::遅延日数3日未満);
        }
        if ($days->lessThan(7)) {
            return new static(self::遅延日数7日未満);
        }
        return new static(self::それ以外);
    }
}
