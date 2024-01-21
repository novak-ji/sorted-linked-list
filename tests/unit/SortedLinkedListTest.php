<?php

declare(strict_types=1);

namespace unit;

use Novakji\SortedLinkedList\Node\Exception\MixedValueTypeException;
use Novakji\SortedLinkedList\Node\NodeFactory;
use Novakji\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

class SortedLinkedListTest extends TestCase
{

    private SortedLinkedList $sortedLinkedList;

    protected function setUp(): void
    {
        parent::setUp();

        $nodeFactory = new NodeFactory();
        $this->sortedLinkedList = new SortedLinkedList($nodeFactory);
    }

    public function testInsertValue(): void
    {
        $this->sortedLinkedList->insertValue('beta');
        $this->sortedLinkedList->insertValue('alfa');
        $this->assertSame(['alfa', 'beta'], $this->sortedLinkedList->getValuesAsArray());
    }

    public function testRemoveValue(): void
    {
        $this->sortedLinkedList->insertValue('beta');
        $this->sortedLinkedList->insertValue('alfa');
        $this->sortedLinkedList->insertValue('gama');
        $this->assertSame(['alfa', 'beta', 'gama'], $this->sortedLinkedList->getValuesAsArray());

        $this->sortedLinkedList->removeValue('beta');
        $this->assertSame(['alfa', 'gama'], $this->sortedLinkedList->getValuesAsArray());
    }

    /** @dataProvider hasValueDataProvider */
    public function testHasValue(int $value, bool $expected): void
    {
        $this->sortedLinkedList->insertValue(1);
        $this->sortedLinkedList->insertValue(3);
        $this->sortedLinkedList->insertValue(2);

        $this->assertSame($expected, $this->sortedLinkedList->hasValue($value));
    }

    /** @return array<int, array<int, int|bool>> */
    public static function hasValueDataProvider(): array
    {
        return [
            [1, true],
            [5, false],
        ];
    }

    public function testCount(): void
    {
        $this->sortedLinkedList->insertValue(1);
        $this->sortedLinkedList->insertValue(3);
        $this->sortedLinkedList->insertValue(2);

        $this->assertSame(3, $this->sortedLinkedList->count());

        $this->sortedLinkedList->insertValue(5);

        $this->assertSame(4, $this->sortedLinkedList->count());

        $this->sortedLinkedList->removeValue(1);
        $this->sortedLinkedList->removeValue(5);

        $this->assertSame(2, $this->sortedLinkedList->count());
    }

    public function testMixedType(): void
    {
        $this->expectException(MixedValueTypeException::class);
        $this->sortedLinkedList->insertValue('foo');
        $this->sortedLinkedList->insertValue(123);
    }

    public function testIterator(): void
    {
        $this->sortedLinkedList->insertValue('beta');
        $this->sortedLinkedList->insertValue('alfa');
        $this->sortedLinkedList->insertValue('gama');

        $expected = [0 => 'alfa', 1 => 'beta', 2 => 'gama'];

        foreach ($this->sortedLinkedList as $key => $value) {
            $this->assertSame($expected[$key], $value);
        }
    }
}
