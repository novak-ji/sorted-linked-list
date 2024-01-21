<?php

declare(strict_types=1);

namespace Novakji\SortedLinkedList;

use Countable;
use Iterator;
use Novakji\SortedLinkedList\Node\Exception\MixedValueTypeException;
use Novakji\SortedLinkedList\Node\NodeFactory;
use Novakji\SortedLinkedList\Node\NodeInterface;

/** @implements Iterator<int, string|int> */
class SortedLinkedList implements Iterator, Countable
{

    private NodeFactory $nodeFactory;

    private ?NodeInterface $head = null;

    private ?NodeInterface $current = null;

    private int $count = 0;

    private int $key = 0;

    public function __construct(NodeFactory $nodeFactory)
    {
        $this->nodeFactory = $nodeFactory;
    }

    public function insertValue(string|int $value): void
    {
        $newNode = $this->nodeFactory->createNode($value);

        if ($this->head !== null && $newNode::class !== $this->head::class) {
            throw new MixedValueTypeException('Values in SortedLikedList must have same type');
        }

        if ($this->head === null || $this->head->hasNodeBeAfterThisNode($newNode) === false) {
            $newNode->setNext($this->head);
            $this->head = $newNode;
        } else {
            $current = $this->head;
            while ($current->getNext() !== null && $current->getNext()->hasNodeBeAfterThisNode($newNode) === true) {
                $current = $current->getNext();
            }
            $newNode->setNext($current->getNext());
            $current->setNext($newNode);
        }

        $this->count++;
    }

    public function hasValue(string|int $value): bool
    {
        $current = $this->head;
        while ($current !== null) {
            if ($current->getValue() === $value) {
                return true;
            }
            $current = $current->getNext();
        }

        return false;
    }

    public function removeValue(string|int $value): void
    {
        $current = $this->head;
        while ($current !== null) {
            if ($current->getValue() === $value || $current->getNext()?->getValue() === $value) {
                $current->setNext($current->getNext()?->getNext());
                $this->count--;
                return;
            }
            $current = $current->getNext();
        }
    }

    /** @return array<int, string|int> */
    public function getValuesAsArray(): array
    {
        $array = [];
        $current = $this->head;

        while ($current !== null) {
            $array[] = $current->getValue();
            $current = $current->getNext();
        }

        return $array;
    }

    public function current(): string|int|null
    {
        return $this->current?->getValue();
    }

    public function next(): void
    {
        if ($this->current === null) {
            return;
        }

        $this->current = $this->current->getNext();
        $this->key++;
    }

    public function key(): int
    {
        return $this->key;
    }

    public function valid(): bool
    {
        return $this->current() !== null;
    }

    public function rewind(): void
    {
        $this->current = $this->head;
        $this->key = 0;
    }

    public function count(): int
    {
        return $this->count;
    }
}
