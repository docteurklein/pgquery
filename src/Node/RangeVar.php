<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class RangeVar implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $relname;
    private $alias;

    public function __construct($name, $children)
    {
        $this->name = $name;
        $this->relname = $children['relname'];
        $this->alias = $children['alias']['Alias']['aliasname'] ?? '';
    }

    public function __toString(): string
    {
        return "{$this->relname} {$this->alias}";
    }
}
