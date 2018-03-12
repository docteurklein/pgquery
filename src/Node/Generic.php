<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class Generic implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ' ';
}
