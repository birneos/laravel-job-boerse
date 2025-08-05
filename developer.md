# Projekt Job-Boerse

## Install

   laravel new JOB-BOERSE
   composer install (in docker)
   npm install 


### User and File Permissions (optional)

  docker compose exec -uroot php bash -c "\
  chown -R www-data:www-data /var/www/html && \
  find /var/www/html -type d -exec chmod 755 {} \; && \
  find /var/www/html -type f -exec chmod 644 {} \; && \
  chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache"


## Clenaup (optional)

php artisan config:clear
docker compose exec php php artisan cache:clear
docker compose exec php php artisan config:cache



## Project-Journal

## Copy Logo to resources/images

  So we use Vite for versions and hashing

## create Layout and include Vite

   layout.blade.de
  ...
    <title>Job Boerse</title>
    @vite(['resources/js/app.js'])
  ...

  