<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;

final class A_Expr implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $kind;
    private $lexpr;
    private $rexpr;

    public function __construct($name, array $children)
    {
        $this->name = $name;
        $this->kind = $children['kind'];
        $this->children['lexpr'] = AST::node('lexpr', $children['lexpr']);
        $this->children['name'] = AST::node('name', $children['name']);
        $this->children['rexpr'] = AST::node('rexpr', $children['rexpr']);
    }
}
