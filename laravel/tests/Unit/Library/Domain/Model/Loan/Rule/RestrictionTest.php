<?php

declare(strict_types=1);

namespace Tests\Unit\Library\Domain\Model\Loan\Rule;

use Library\Domain\Exception\DateFormatException;
use Library\Domain\Model\Loan\Loan;
use Library\Domain\Model\Loan\LoanDate;
use Library\Domain\Model\Loan\Loans;
use Library\Domain\Model\Loan\Rule\Restriction;
use Library\Domain\Model\Member\Member;
use Library\Domain\Model\Member\MemberNumber;
use Library\Domain\Model\Member\MemberType;
use Library\Domain\Model\Member\Name;
use Library\Domain\Type\Date\CurrentDate;
use PHPUnit\Framework\TestCase;

/**
 * Class RestrictionTest
 * @package Tests\Unit\Library\Domain\Model\Loan\Rule
 */
class RestrictionTest extends TestCase
{
    /**
     * @test
     * @dataProvider 貸出制限データ
     * @param string $memberType
     * @param string $loanDate1
     * @param string|null $loanDate2
     * @param string $expected
     * @throws DateFormatException
     */
    public function 貸出制限の判定ができる(string $memberType, string $loanDate1, ?string $loanDate2, string $expected): void
    {
        $currentDate = CurrentDate::parse('2020-01-20');
        $memberNumber = MemberNumber::create(1);
        $member = Member::create($memberNumber, Name::create(''), new MemberType($memberType));

        $loans = [];
        $loans[] = Loan::create(null, $member, null, LoanDate::parse($loanDate1));

        if ($loanDate2 !== null) {
            $loans[] = Loan::create(null, $member, null, LoanDate::parse($loanDate2));
        }

        $restriction = Restriction::create($member, Loans::from($loans), $currentDate);

        self::assertSame($expected, $restriction->ofQuantity()->getValue());
    }

    public function 貸出制限データ(): array
    {
        return [
            '貸出5冊まで:大人、遅延日数2' => [
                'memberType' => '大人',
                'loanDate1' => '2020-01-04',
                'loanDate2' => null,
                'expected' => '貸出5冊まで'
            ],
            '貸出し不可:大人、遅延日数3' => [
                'memberType' => '大人',
                'loanDate1' => '2020-01-04', // loanDate1だけなら遅延日数2
                'loanDate2' => '2020-01-03', // loanDate2の遅延日数が3であり貸出不可になる
                'expected' => '貸出不可'
            ],
            '貸出し不可:大人、遅延日数6' => [
                'memberType' => '大人',
                'loanDate1' => '2020-01-04', // loanDate1だけなら遅延日数2
                'loanDate2' => '2019-12-31', // loanDate2の遅延日数が6であり貸出不可になる
                'expected' => '貸出不可'
            ],
            '貸出し不可:大人、遅延日数7' => [
                'memberType' => '大人',
                'loanDate1' => '2020-01-04', // loanDate1だけなら遅延日数2
                'loanDate2' => '2019-12-30', // loanDate2の遅延日数が7であり貸出不可になる
                'expected' => '貸出不可'
            ],
            '貸出5冊まで:子供、遅延日数2' => [
                'memberType' => '子供',
                'loanDate1' => '2020-01-04',
                'loanDate2' => null,
                'expected' => '貸出7冊まで'
            ],
            '貸出4冊まで:子供、遅延日数3' => [
                'memberType' => '子供',
                'loanDate1' => '2020-01-04', // loanDate1だけなら遅延日数2
                'loanDate2' => '2020-01-03', // loanDate2の遅延日数が3であり貸出4冊までになる
                'expected' => '貸出4冊まで'
            ],
            '貸出4冊まで:子供、遅延日数6' => [
                'memberType' => '子供',
                'loanDate1' => '2020-01-04', // loanDate1だけなら遅延日数2
                'loanDate2' => '2019-12-31', // loanDate2の遅延日数が6であり貸出4冊までになる
                'expected' => '貸出4冊まで'
            ],
            '貸出5冊まで:子供、遅延日数7' => [
                'memberType' => '子供',
                'loanDate1' => '2020-01-04', // loanDate1だけなら遅延日数2
                'loanDate2' => '2019-12-30', // loanDate2の遅延日数が7であり貸出不可になる
                'expected' => '貸出不可'
            ],
        ];
    }
}
