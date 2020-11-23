<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan\Delay;

use Library\Domain\Type\Date\Days;

/**
 * 遅延日数
 */
final class DaysLate
{
    /**
     * @var Days
     */
    private Days $value;

    private function __construct(Days $value)
    {
        $this->value = $value;
    }

    public static function create(int $delays): DaysLate
    {
        return new static(Days::create($delays));
    }

    public function intValue(): int
    {
        return $this->value->value();
    }

    public function delayStatus(): DelayStatus
    {
        return DelayStatus::level($this->value);
    }
}
