[![PHP Composer](https://github.com/novak-ji/sorted-linked-list/actions/workflows/php.yml/badge.svg)](https://github.com/novak-ji/sorted-linked-list/actions/workflows/php.yml)

PHP library providing SortedLinkedList (linked list that keeps values sorted). SortedLinkedList can hold string or int values, but not both together.

## Installation

```
composer require novak-ji/sorted-linked-list
```

## Usage

```php
<?php

use Novakji\SortedLinkedList\Node\NodeFactory;
use Novakji\SortedLinkedList\SortedLinkedList;

$nodeFactory = new NodeFactory();
$sortedLinkedList = new SortedLinkedList($nodeFactory);

$sortedLinkedList->insertValue('beta'); //beta
$sortedLinkedList->insertValue('alfa'); //alfa -> beta
$sortedLinkedList->insertValue('aaa'); //aaa -> alfa -> beta

$sortedLinkedList->removeValue('alfa'); //aaa -> beta

$sortedLinkedList->hasValue('aaa'); //true
$sortedLinkedList->hasValue('alfa'); //false
```
SortedLinkedList implementing Iterator and Countable interfaces
```php
<?php
$sortedLinkedList->count(); //int

/** @var string|int $value */
foreach ($sortedLinkedList as $value) {

}
```

##  Code Quality
PHP Linter
```bash
composer phplint
```

PHP_CodeSniffer
```bash
composer phpcs
```
```bash
composer phpcbf
```

PHPStan
```bash
composer phpstan
```

PHPUnit - unit tests
```bash
composer test-unit
```

Run all checks
```bash
composer check
```
