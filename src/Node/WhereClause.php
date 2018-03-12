<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class WhereClause implements Node
{
    use DefaultBehavior;

    const prefix = 'where ';
    const separator = ' and ';
}
