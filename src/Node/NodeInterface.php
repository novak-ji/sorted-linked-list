<?php

namespace Novakji\SortedLinkedList\Node;

interface NodeInterface
{
    /** @return string|int */
    public function getValue();

    public function getNext(): ?NodeInterface;

    public function setNext(?NodeInterface $next): void;

    public function hasNodeBeAfterThisNode(NodeInterface $node): bool;
}
