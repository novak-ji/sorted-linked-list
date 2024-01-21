<?php

declare(strict_types=1);

namespace unit\Node;

use Novakji\SortedLinkedList\Node\Exception\InvalidNodeTypeException;
use Novakji\SortedLinkedList\Node\IntNode;
use Novakji\SortedLinkedList\Node\StringNode;
use PHPUnit\Framework\TestCase;

class StringNodeTest extends TestCase
{
    public function testCreating(): void
    {
        $node = new StringNode('alfa');
        $this->assertSame('alfa', $node->getValue());
        $this->assertNull($node->getNext());
    }

    public function testNext(): void
    {
        $node = new StringNode('alfa');
        $nextNode = new StringNode('beta');
        $node->setNext($nextNode);
        $this->assertSame($nextNode, $node->getNext());
    }

    public function testHasNodeBeAfterThisNode(): void
    {
        $node = new StringNode('beta');
        $biggerNode = new StringNode('gama');
        $smallerNode = new StringNode('alfa');

        $this->assertTrue($node->hasNodeBeAfterThisNode($biggerNode));
        $this->assertFalse($node->hasNodeBeAfterThisNode($smallerNode));
    }

    public function testInvalidComparison(): void
    {
        $node = new StringNode('foo');
        $invalidNode = new IntNode(123);

        $this->expectException(InvalidNodeTypeException::class);
        $node->hasNodeBeAfterThisNode($invalidNode);
    }
}
