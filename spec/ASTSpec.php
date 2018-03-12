<?php

namespace spec\DocteurKlein\PgQuery;

use DocteurKlein\PgQuery\AST;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ASTSpec extends ObjectBehavior
{
    function it_conserves_sql()
    {
        $this->beConstructedWith('select * from test');

        $this->toSql()->shouldBe('select * from test');
    }
}
