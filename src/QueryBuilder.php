<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery;

use DocteurKlein\PgQuery\AST;
use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\Node\RawSqlNode;

final class QueryBuilder
{
    private $ast;

    public function __construct(AST $ast)
    {
        $this->ast = $ast;
    }

    public static function fromSql(string $sql): self
    {
        return new self(new AST($sql));
    }

    public function walk(callable $visitor): void
    {
        $this->ast->walk($visitor);
    }

    public function addWhere(string $where): void
    {
        $this->walk(function(Node $node) use($where) {
            if ($node->is('whereClause')) {
                $node->add(new RawSqlNode($where));
            }
        });
    }

    public function toSql(): string
    {
        return $this->ast->toSql();
    }

    public function __toString(): string
    {
        return (string)$this->ast;
    }
}
