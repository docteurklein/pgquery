<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;

final class TypeCast implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $arg;
    private $typeName;

    public function __construct($name, array $children)
    {
        $this->arg = AST::node('arg', $children['arg']);
        $this->typeName = AST::node('typeName', $children['typeName']['TypeName']);
    }

    public function __toString(): string
    {
        $string = (string)$this->arg;
        if ((string)$this->typeName == 'pg_catalog.bool') {
            $string = $string === 't' ? 'true' : 'false';
        }

        return $string;
    }
}
