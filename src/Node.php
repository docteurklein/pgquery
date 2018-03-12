<?php declare(strict_types=1);

namespace DocteurKlein\PgQuery;

interface Node
{
    public function is($name): bool;

    public function __toString(): string;

    public function add(self $child): void;
}
