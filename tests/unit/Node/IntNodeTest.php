<?php

declare(strict_types=1);

namespace unit\Node;

use Novakji\SortedLinkedList\Node\Exception\InvalidNodeTypeException;
use Novakji\SortedLinkedList\Node\IntNode;
use Novakji\SortedLinkedList\Node\StringNode;
use PHPUnit\Framework\TestCase;

class IntNodeTest extends TestCase
{
    public function testCreating(): void
    {
        $node = new IntNode(123);
        $this->assertSame(123, $node->getValue());
        $this->assertNull($node->getNext());
    }

    public function testNext(): void
    {
        $node = new IntNode(123);
        $nextNode = new IntNode(124);
        $node->setNext($nextNode);
        $this->assertSame($nextNode, $node->getNext());
    }

    public function testHasNodeBeAfterThisNode(): void
    {
        $node = new IntNode(10);
        $biggerNode = new IntNode(20);
        $smallerNode = new IntNode(5);

        $this->assertTrue($node->hasNodeBeAfterThisNode($biggerNode));
        $this->assertFalse($node->hasNodeBeAfterThisNode($smallerNode));
    }

    public function testInvalidComparison(): void
    {
        $node = new IntNode(123);
        $invalidNode = new StringNode('Foo');

        $this->expectException(InvalidNodeTypeException::class);
        $node->hasNodeBeAfterThisNode($invalidNode);
    }
}
