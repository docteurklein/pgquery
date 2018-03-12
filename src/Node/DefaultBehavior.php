<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;
use DocteurKlein\PgQuery\Node\Generic;

trait DefaultBehavior

{
    public $name;
    public $children = [];

    public function __construct($name, $children)
    {
        $this->name = $name;
        if (is_array($children)) {
            $this->children = AST::nodes($children);
        }
    }

    public function is($name): bool
    {
        return $this->name === $name;
    }

    public function __toString(): string
    {
        return self::prefix.implode(self::separator, array_filter($this->children, function($child) {
            return (string)$child;
        }));
    }

    public function add(Node $node): void
    {
        $this->children[] = $node;
    }
}
