<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class Integer implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    private $ival;

    public function __construct($name, array $children)
    {
        $this->ival = $children['ival'];
    }

    public function __toString(): string
    {
        return (string)$this->ival;
    }
}
