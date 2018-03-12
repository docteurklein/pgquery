PHP_ARG_WITH(pgquery, for libpg_query support,
[  --with-pgquery[=DIR]        Include pgquery support])

if test "$PHP_PGQUERY" != "no"; then
  if test -r $PHP_PGQUERY/libpg_query.a; then
    PGQUERY_DIR=$PHP_PGQUERY
    AC_MSG_RESULT(found in $PHP_PGQUERY)
  else
    AC_MSG_CHECKING(for libpg_query in default path)
    for i in /usr/local /usr; do
      if test -r $i/lib/libpg_query.a; then
        PGQUERY_DIR=$i
        AC_MSG_RESULT(found in $i)
      fi
    done
  fi

  if test -z "$PGQUERY_DIR"; then
    AC_MSG_RESULT(not found)
    AC_MSG_ERROR(Please reinstall the libpg_query distribution - pgquery.h should be in <pgquery-dir>/include and libpg_query.a should be in <pgquery-dir>/lib)
  fi
  PHP_ADD_LIBRARY_WITH_PATH(pg_query, $PGQUERY_DIR, PGQUERY_SHARED_LIBADD)
  PHP_SUBST(PGQUERY_SHARED_LIBADD)
  AC_DEFINE(HAVE_PGQUERY,1,[ ])

  PHP_NEW_EXTENSION(pgquery, pgquery.c, $ext_shared)
fi
