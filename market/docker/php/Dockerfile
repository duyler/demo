FROM spiralscout/roadrunner as roadrunner

FROM duyler/php-zts

WORKDIR /var/www

RUN docker-php-ext-enable pdo_pgsql
RUN docker-php-ext-enable pgsql
RUN docker-php-ext-enable bcmath
RUN docker-php-ext-enable filter

# Copy the RoadRunner binary from the roadrunner image to the local bin directory
COPY --from=roadrunner /usr/bin/rr /usr/local/bin/rr

# Run the RoadRunner server command
CMD rr serve -c .rr.yaml

# Run conslole application
#CMD php runtime/cli.php
