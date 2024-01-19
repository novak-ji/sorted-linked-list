<?php

declare(strict_types=1);

namespace unit;

use Novakji\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

class SortedLinkedListTest extends TestCase
{
    public function testOutput(): void
    {
        $sortedLinkedList = new SortedLinkedList();
        $this->assertSame('Test', $sortedLinkedList->test());
    }
}
