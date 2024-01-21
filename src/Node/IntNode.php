<?php

declare(strict_types=1);

namespace Novakji\SortedLinkedList\Node;

use Novakji\SortedLinkedList\Node\Exception\InvalidNodeTypeException;

class IntNode implements NodeInterface
{

    private int $value;

    private ?NodeInterface $next = null;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getNext(): ?NodeInterface
    {
        return $this->next;
    }

    public function setNext(?NodeInterface $next): void
    {
        $this->next = $next;
    }

    public function hasNodeBeAfterThisNode(NodeInterface $node): bool
    {
        if ($node instanceof IntNode === false) {
            throw new InvalidNodeTypeException('Comparison can be done only on same node type');
        }

        return $node->getValue() > $this->value;
    }
}
