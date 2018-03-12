<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;

final class TypeName implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    public function __construct($name, array $children)
    {
        $this->name = $name;
        $this->children = AST::nodes($children['names']);
    }

    public function __toString(): string
    {
        return implode('.', $this->children);
    }
}
