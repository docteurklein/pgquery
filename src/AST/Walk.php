<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery\AST;

use DocteurKlein\PgQuery\Node\Generic;
use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST;

final class Walk
{
    private $walker;
    private $visitor;

    public function __construct(callable $visitor)
    {
        $this->visitor = $visitor;
        $this->walker = function(Node $node, $key) {
            ($this->visitor)($node);
            array_walk($node->children, $this->walker);
        };
    }

    public function __invoke(array $nodes): void
    {
        array_walk($nodes, $this->walker);
    }
}
