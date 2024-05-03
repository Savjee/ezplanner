# Use Composer to grab all PHP dependencies
FROM serversideup/php:8.3-cli-alpine as php-dependencies
    WORKDIR /build
    COPY --chown=www-data:www-data . .
    RUN composer install --no-dev

# Build JS and CSS assets with Vite. Here we need the PHP dependencies to
# get the Livewire source
FROM node:lts as asset-build
    WORKDIR /build
    COPY . .
    COPY --chown=www-data:www-data --from=php-dependencies /build /build/
    RUN npm install
    RUN npm run build

# Build the actual image to run EZPlanner
FROM serversideup/php:8.3-unit
    WORKDIR /var/www/html

    # Enable Laravel automations from serversideup
    # Ie: migrate database, link storage, cache config & routes, etc.
    ENV AUTORUN_ENABLED=true

    # Copy the main Laravel app
    COPY --chown=www-data:www-data . .

    # Copy dependencies
    COPY --chown=www-data:www-data --from=php-dependencies /build .

    # Copy the built assets
    COPY --chown=www-data:www-data --from=asset-build /build/public/build public/build