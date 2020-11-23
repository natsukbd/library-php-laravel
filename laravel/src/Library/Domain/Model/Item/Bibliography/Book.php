<?php

declare(strict_types=1);

namespace Library\Domain\Model\Item\Bibliography;

/**
 * 本
 */
final class Book
{
    private BookNumber $bookNumber;

    private Title $title;

    private Author $author;

    private function __construct(BookNumber $bookNumber, Title $title, Author $author)
    {
        $this->bookNumber = $bookNumber;
        $this->title = $title;
        $this->author = $author;
    }

    public static function create(BookNumber $bookNumber, Title $title, Author $author): Book
    {
        return new static($bookNumber, $title, $author);
    }

    public function bookNumber(): BookNumber
    {
        return $this->bookNumber;
    }

    public function title(): Title
    {
        return $this->title;
    }
}
