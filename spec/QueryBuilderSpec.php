<?php

namespace spec\DocteurKlein\PgQuery;

use DocteurKlein\PgQuery\QueryBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QueryBuilderSpec extends ObjectBehavior
{
    function it_adds_where()
    {
        $this->beConstructedThrough('fromSql', ['select * from test']);

        $this->addWhere('id = :id');

        $this->toSql()->shouldBe('select * from test where id = :id');
    }
}
