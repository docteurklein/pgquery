<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;

final class FuncCall implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $funcname;

    public function __construct($name, array $children)
    {
        $this->name = $name;
        $this->funcname = AST::node('funcname', $children['funcname']);
        $this->children = AST::nodes($children['args'] ?? []);
    }

    public function __toString(): string
    {
        return sprintf('%s(%s)', (string)$this->funcname, implode(', ', array_map(function($child) {
            if ($child->is('A_Const')) {
                return  "'".$child."'";
            }
            return $child;
        }, $this->children)));
    }
}
