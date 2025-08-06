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

  update welcome.blade.php with new layout 
  ...
    <x-layout>    
    </x-layout>
  ...  

  create production files for versioning and image cache bursting

    npm run build 

  we get an error after reloading page

    " Unable to locate file in Vite manifest: resources/images/logo.svg. "

  Activate Cache busting and image versioning in vite and again "npm run build" now with see
  also the cached image file

    resources/js/app.js and add following

    //versioning images
    import.meta.glob([
      '../images/**'
    ]);

#### Now install tailwindcss 

    tailwindcss.com -> docs -> installation -> Framework Guides -> Laravel

        npm install tailwindcss @tailwindcss/vite


#### Integrate google fonts

  Add following Fonts to your app.css and you
  can use it in your tags like '<body class="font-hanken-grotesk">'

  Resource/css/app.css

  ```
  @import url("https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet");
   

    @theme {
        --font-hanken-grotesk: 'Hanken+Grotesk',sans-serif;
    }
  ```
#### Customizing font-size

  I need for Tags a 10px font-size, add customizing to app.css
  This overwrite "text-2xs" thats per default has 12px

  ```
  @theme {
    --text-2xs: 0.625rem;
}

  ```

### Tailwind group - cool

  I want hover over a job-card element and want blue text
  for the a-tag element with text of h3 element

  1. add the word "group" to your parent element
  2. add "group-hover:text-blue-600" to h3 element

    ```
        <div  class="... group">
            <div class="self-start text-sm">Laracasts</div>
            <div class="py-8 font-bold">
                <h3 class="group-hover: text-blue-600">Video Producer</h3>
              ...
            </div>
</div>
    ```
  