<?php

declare(strict_types=1);

namespace Novakji\SortedLinkedList\Node;

class NodeFactory
{
    public function createNode(string|int $value): NodeInterface
    {
        if (is_string($value) === true) {
            return new StringNode($value);
        }

        return new IntNode($value);
    }
}
