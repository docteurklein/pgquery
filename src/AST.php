<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery;

use DocteurKlein\PgQuery\Node\Generic;
use DocteurKlein\PgQuery\Node;
use DocteurKlein\PgQuery\AST\Walk;

final class AST
{
    private $nodes;

    public function __construct(string $sql)
    {
        $this->nodes = self::nodes(json_decode(pg_parse($sql), true));
    }

    public static function node($key, $value): Node
    {
        $name = $key;
        if ($name === 'String') {
            $name = 'StringStmt';
        }
        if (is_int($name)) {
            $name = 'Generic';
        }
        $class = __NAMESPACE__.'\\Node\\'.ucfirst($name);
        if (!class_exists($class)) {
            $class = Generic::class;
        }
        return new $class($key, $value);
    }

    public static function nodes(array $values): array
    {
        return array_map([self::class, 'node'], array_keys($values), $values);
    }

    public function walk(callable $visitor): void
    {
        (new Walk($visitor))($this->nodes);
    }

    public function find(callable $criteria): array
    {
        $found = [];
        $this->walk(function($node) use($criteria, &$found) {
            if ($criteria($node)) {
                $found[] = $node;
            }
        });

        return $found;
    }

    public function findOne(callable $criteria): ?Node
    {
        $found = $this->find($criteria);

        return current($found) ?: null;
    }

    public function toSql(): string
    {
        $sql = implode($this->nodes);

        pg_parse($sql);

        return $sql;
    }

    public function __toString(): string
    {
        return implode("\n", [
            print_r($this->nodes, true),
            json_encode(json_decode(pg_parse($this->toSql()), true), JSON_PRETTY_PRINT),
        ]);
    }
}
