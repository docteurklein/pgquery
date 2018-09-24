<?php declare(strict_types=1);

use DocteurKlein\PgQuery\QueryBuilder;
use DocteurKlein\PgQuery\AST;

require(__DIR__.'/../vendor/autoload.php');

$qb = new QueryBuilder($ast = new AST($argv[1]));
if (isset($argv[2])) {
    $qb->addWhere($argv[2]);
}

//$qb->walk(function($node) {
//    var_dump($node);
//});

var_dump($ast->find(function() {
    return true;
}));

var_dump((string)$qb);
var_dump($qb->toSql());
