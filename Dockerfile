FROM alpine:edge as build

RUN apk add --no-cache php7-dev g++ make

COPY libpg_query /libpg_query
RUN cd /libpg_query && make

WORKDIR /ext
COPY ext .
RUN phpize
RUN ./configure --with-pgquery=/libpg_query
RUN make

FROM alpine:edge

RUN apk add --no-cache php7 php7-tokenizer php7-json php7-iconv php7-mbstring

COPY --from=build /ext/modules/pgquery.so /usr/lib/php7/modules/
RUN echo 'extension=pgquery.so' > /etc/php7/conf.d/pgquery.ini

WORKDIR /pgquery
ENV PATH=$PATH:vendor/bin
