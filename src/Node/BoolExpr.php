<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;

final class BoolExpr implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $boolop;

    public function __construct($name, array $children)
    {
        $this->name = $name;
        $this->boolop = $children['boolop'] == '0' ? ' and ' : ' or ';
        $this->children = AST::nodes($children['args']);
    }

    public function __toString(): string
    {
        return '('.implode($this->boolop, $this->children).')';
    }
}
