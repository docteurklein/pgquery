<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\Node;

use DocteurKlein\PgQuery\Node;

final class TargetList implements Node
{
    use DefaultBehavior;

    const prefix = '';
    const separator = ', ';
}
