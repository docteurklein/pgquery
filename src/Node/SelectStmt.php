<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class SelectStmt implements Node
{
    use DefaultBehavior;

    const prefix = 'select ';
    const separator = ' ';
}
