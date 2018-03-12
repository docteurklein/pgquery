<?php declare(strict_types=1);

use DocteurKlein\PgQuery\QueryBuilder;
use DocteurKlein\PgQuery\Node\RawSqlNode;

require(__DIR__.'/../vendor/autoload.php');

$qb = QueryBuilder::fromSql($argv[1]);
$qb->addWhere($argv[2]);

$qb->walk(function($node) {
    if ($node->is('BoolExpr')) {
        $node->add(new RawSqlNode('active = true'));
    }
    return $node;
});

var_dump((string)$qb);
echo($qb->toSql());
