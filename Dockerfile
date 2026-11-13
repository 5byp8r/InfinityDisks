FROM tomsik68/lamp:8.4

WORKDIR /var/www/html

# Na Vercel, execute apenas o Apache; o banco deve ser persistente e externo.
# Substitui o /init da imagem, que iniciaria tambem o MariaDB local.
ENTRYPOINT ["docker-php-entrypoint"]
CMD ["apache2-foreground"]
STOPSIGNAL SIGWINCH
HEALTHCHECK NONE

COPY --chown=www-data:www-data model/ ./model/
COPY --chown=www-data:www-data controller/ ./controller/
COPY --chown=www-data:www-data view/ ./view/
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && a2disconf lamp \
    && php -r 'exit(extension_loaded("pdo_mysql") ? 0 : 1);'

EXPOSE 80
