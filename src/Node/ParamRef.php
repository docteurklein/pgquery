<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;

final class ParamRef implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $number;
    private $location;

    public function __construct($name, array $children)
    {
        $this->name = $name;
        $this->number = $children['number'] ?? null;
        $this->location = $children['location'];
    }

    public function __toString(): string
    {
        return $this->number ? '$'.$this->number : '?';
    }
}
