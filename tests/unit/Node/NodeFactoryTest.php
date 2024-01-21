<?php

declare(strict_types=1);

namespace unit\Node;

use Novakji\SortedLinkedList\Node\IntNode;
use Novakji\SortedLinkedList\Node\NodeFactory;
use Novakji\SortedLinkedList\Node\StringNode;
use PHPUnit\Framework\TestCase;

class NodeFactoryTest extends TestCase
{

    private NodeFactory $nodeFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->nodeFactory = new NodeFactory();
    }

    public function testCreatingStringNode(): void
    {
        $stringNode = $this->nodeFactory->createNode('foo');
        $this->assertInstanceOf(StringNode::class, $stringNode);
    }

    public function testCreatingIntNode(): void
    {
        $intNode = $this->nodeFactory->createNode(123);
        $this->assertInstanceOf(IntNode::class, $intNode);
    }
}
