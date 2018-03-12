<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class RawSqlNode implements Node
{
    private $value;
    public $children = [];

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function is($name): bool
    {
        return $this->value === $name;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function add(Node $child): void
    {
        $this->value .= $node;
    }
}
