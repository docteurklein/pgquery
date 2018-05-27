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
        $this->children['funcname'] = AST::node('funcname', $children['funcname']);
    }

    public function __toString(): string
    {
        return sprintf('%s()', (string)$this->children['funcname']);
    }
}
