<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;

final class A_Const implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $val;

    public function __construct($name, array $children)
    {
        $this->name = $name;
        $this->val = AST::node('val', $children['val']);
    }

    public function __toString(): string
    {
        return (string)$this->val;
    }
}
