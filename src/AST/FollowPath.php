<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\AST;

use DocteurKlein\PgQuery\Node\Generic;
use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;

final class FollowPath
{
    private $visitor;

    public function __construct(callable $visitor)
    {
        $this->visitor = $visitor;
    }

    public function __invoke(array $nodes, array $path, callable $then)
    {
        $step = array_shift($path);

        $criteria = $step;
        if (is_string($step)) {
            $criteria = function($node) use($step) {
                return $node->is($step);
            };
        }
        if (null === $step) {
            return $then($node);
        }
    }
}
