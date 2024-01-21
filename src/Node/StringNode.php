<?php

declare(strict_types=1);

namespace Novakji\SortedLinkedList\Node;

use Novakji\SortedLinkedList\Node\Exception\InvalidNodeTypeException;

class StringNode implements NodeInterface
{

    private string $value;

    private ?NodeInterface $next = null;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
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
        if ($node instanceof StringNode === false) {
            throw new InvalidNodeTypeException('Comparison can be done only on same node type');
        }

        return strcmp($this->value, $node->getValue()) < 0;
    }
}
