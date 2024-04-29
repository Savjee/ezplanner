FROM serversideup/php:beta-8.3-cli as php-dependencies
    WORKDIR /build
    COPY --chown=www-data:www-data . .
    RUN composer install --no-dev

# Build JS and CSS assets with Vite
FROM node:lts as asset-build
    WORKDIR /build
    COPY . .
    COPY --chown=www-data:www-data --from=php-dependencies /build /build/
    RUN npm install
    RUN npm run build

# Build an image to run EZPlanner
FROM serversideup/php:beta-8.3-unit
    WORKDIR /var/www/html

    ENV SECTIONS="Wij,Lewis,Vince,TestDocker"

    # Enable Laravel automations from serversideup
    # Ie: migrate database, link storage, cache config & routes, etc.
    ENV AUTORUN_ENABLED=true

    # Copy the main Laravel app
    COPY --chown=www-data:www-data . .

    # Install dependencies
    COPY --chown=www-data:www-data --from=php-dependencies /build .
    # RUN composer install --no-dev

    # Copy the built assets
    COPY --chown=www-data:www-data --from=asset-build /build/public/build public/build
