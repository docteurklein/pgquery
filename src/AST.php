<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery;

use DocteurKlein\PgQuery\Node\Generic;

final class AST
{
    private $ast;
    private $raw;
    private $walker;

    public function __construct(string $sql)
    {
        $this->raw = json_decode(pg_parse($sql), true);

        $this->ast = array_map([self::class, 'node'], array_keys($this->raw), $this->raw);
        $this->ast = self::nodes($this->raw);

        $this->walker = function(Node $node, $key, $visitor) {
            $visitor($node);
            array_walk($node->children, $this->walker, $visitor);
        };
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
        array_walk($this->ast, $this->walker, $visitor);
    }

    public function toSql(): string
    {
        $sql = implode($this->ast)."\n";

        pg_parse($sql);

        return $sql;
    }

    public function __toString(): string
    {
        return print_r($this->ast, true)."\n".json_encode($this->raw, JSON_PRETTY_PRINT);
    }
}
