<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class Alias implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $alias;

    public function __construct($name, array $children)
    {
        $this->name = $name;
        $this->alias = $children['Alias']['aliasname'];
    }

    public function __toString(): string
    {
        return (string)$this->alias;
    }
}
