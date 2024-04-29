# Build JS and CSS assets with Vite
FROM node:lts as asset-build
    WORKDIR /build
    COPY . .
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
    RUN composer install --no-dev

    # Copy the built assets
    COPY --chown=www-data:www-data --from=asset-build /build/public/build public/build

    # Generate a artisan
    RUN php artisan key:generate
