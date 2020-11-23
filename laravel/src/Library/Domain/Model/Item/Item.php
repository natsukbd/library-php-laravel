<?php

declare(strict_types=1);

namespace Library\Domain\Model\Item;

use Library\Domain\Model\Item\Bibliography\Book;

/**
 * 蔵書
 */
final class Item
{
    private ItemNumber $itemNumber;

    private Book $book;

    private function __construct(ItemNumber $itemNumber, Book $book)
    {
        $this->itemNumber = $itemNumber;
        $this->book = $book;
    }

    public static function create(ItemNumber $itemNumber, Book $book): Item
    {
        return new static($itemNumber, $book);
    }

    public function itemNumber(): ItemNumber
    {
        return $this->itemNumber;
    }

    public function book(): Book
    {
        return $this->book;
    }
}
