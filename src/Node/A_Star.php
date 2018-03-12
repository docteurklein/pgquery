<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class A_Star implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';

    public function __toString(): string
    {
        return '*';
    }
}
