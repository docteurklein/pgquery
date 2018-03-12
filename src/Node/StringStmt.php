<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class StringStmt implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $str;

    public function __construct($name, array $children)
    {
        $this->str = $children['str'];
    }

    public function __toString(): string
    {
        return (string)$this->str;
    }
}
