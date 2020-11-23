<?php

declare(strict_types=1);

namespace Tests\Unit\Library\Application\Service\Loan;

use Library\Application\Service\Loan\LoanQueryService;
use Library\Application\Service\Loan\LoanRecordService;
use Library\Domain\Model\Item\Bibliography\Author;
use Library\Domain\Model\Item\Bibliography\Book;
use Library\Domain\Model\Item\Bibliography\BookNumber;
use Library\Domain\Model\Item\Bibliography\Title;
use Library\Domain\Model\Item\Item;
use Library\Domain\Model\Item\ItemNumber;
use Library\Domain\Model\Loan\LoanDate;
use Library\Domain\Model\Loan\LoanRequest;
use Library\Domain\Model\Member\Member;
use Library\Domain\Model\Member\MemberNumber;
use Library\Domain\Model\Member\MemberType;
use Library\Domain\Model\Member\Name;
use Library\Infrastructure\InMemory\Loan\InMemoryLoanRepository;
use PHPUnit\Framework\TestCase;

/**
 * Class LoanRecordServiceTest
 * @package Tests\Unit\Library\Application\Service\Loan
 */
final class LoanRecordServiceTest extends TestCase
{
    /**
     * @test
     */
    public function 貸出を登録できる(): void
    {
        $itemNumber = ItemNumber::create('2-A');
        $memberNumber = MemberNumber::create(1);
        $book = Book::create(BookNumber::create(1), Title::create('タイトル'), Author::create('著者'));
        $loanRequest = LoanRequest::create($memberNumber, $itemNumber, LoanDate::parse('2020-02-20'));

        $inMemoryLoanRepository = new InMemoryLoanRepository();
        $inMemoryLoanRepository->addMember(Member::create($memberNumber, Name::create('名前'), MemberType::大人()));
        $inMemoryLoanRepository->addItem(Item::create($itemNumber, $book));

        (new LoanRecordService($inMemoryLoanRepository))->loaned($loanRequest);

        $loan = (new LoanQueryService($inMemoryLoanRepository))->findBy($itemNumber);
        self::assertSame($loan->member()->number()->value(), 1);
        self::assertSame($loan->date()->value(), '2020-02-20');
    }
}
