
#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "php_ini.h"
#include "ext/standard/info.h"
#include "zend_exceptions.h"
#include "php_pgquery.h"
#include "../libpg_query/pg_query.h"

PHP_FUNCTION(pg_parse)
{
    char* sql;
    size_t sql_len;

    PgQueryParseResult result;
    if (zend_parse_parameters(ZEND_NUM_ARGS(), "s", &sql, &sql_len) == FAILURE) {
        return;
    }
    result = pg_query_parse(sql);

    if (result.error) {
        zend_throw_exception_ex(NULL, 1, "error: %s at location %d:\n\n%s\n", result.error->message, result.error->cursorpos, sql);
    }

    RETVAL_STRING(result.parse_tree);


    pg_query_free_parse_result(result);
}

PHP_MINIT_FUNCTION(pgquery)
{
    return SUCCESS;
}

PHP_MSHUTDOWN_FUNCTION(pgquery)
{
    return SUCCESS;
}

PHP_MINFO_FUNCTION(pgquery)
{
    php_info_print_table_start();
    php_info_print_table_header(2, "pgquery support", "enabled");
    php_info_print_table_end();
}

const zend_function_entry pgquery_functions[] = {
    PHP_FE(pg_parse,    NULL)
    PHP_FE_END    /* Must be the last line in pgquery_functions[] */
};

zend_module_entry pgquery_module_entry = {
    STANDARD_MODULE_HEADER,
    "pgquery",
    pgquery_functions,
    PHP_MINIT(pgquery),
    PHP_MSHUTDOWN(pgquery),
    NULL,
    NULL,
    PHP_MINFO(pgquery),
    PHP_PGQUERY_VERSION,
    STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_PGQUERY
#ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
#endif
ZEND_GET_MODULE(pgquery)
#endif

