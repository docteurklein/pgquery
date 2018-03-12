# pgquery

A php extension + userland lib that uses lib_pgquery to manipulate sql queries via a query builder.

    (cd libpg_query && make)
    (cd ext && phpize && ./configure --with-pgquery=../libpg_query && make)

    php -d extension=ext/modules/pgquery.so examples/test.php "$(cat test.sql)"


## docker usage

    docker build -t pgquery .

    docker run --rm -v $PWD:/pgquery pgquery php examples/test.php "select * from test" "where id = 1" 'active = false'

