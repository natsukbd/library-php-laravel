<?php

declare(strict_types=1);

namespace Library\Domain\Model\Loan;

use Illuminate\Support\Carbon;
use Library\Domain\Exception\DateFormatException;

/**
 * 貸出日
 */
final class LoanDate
{
    private const DATE_FORMAT = 'Y-m-d';

    private Carbon $value;

    public function __construct(Carbon $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $string
     * @return LoanDate
     * @throws DateFormatException
     */
    public static function parse(string $string): LoanDate
    {
        $value = Carbon::make($string);
        if ($value === null) {
            throw new DateFormatException('フォーマットが不正です' . $value);
        }
        return new static($value);
    }

    public function value(): string
    {
        return $this->value->format(self::DATE_FORMAT);
    }
}
