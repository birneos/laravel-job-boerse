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

### blades and css

    You can create component and passing additional css, to combine
    both you can go diffent ways

    // Define with @php directive class variable with css
     ```
     
          @php
              $classes = 'p-4 bg-white/10 rounded-xl flex flex-col text-center border border-transparent hover:border-blue-800 group  transition-colors duration-300'
      @endphp
      
      <div {{ $attributes(['class'=>$classes]) }}>
        {{ $slot }}
      </div>
     ```


    ```
      // Merge
      <div {{ $attributes->merge(['class'=>$classes]) }}>
        {{ $slot }}
      </div>
     ```

     
    ```
      // Same like merge
      <div {{ $attributes(['class'=>$classes]) }}>
        {{ $slot }}
      </div>
     ```


#### Different Tag Size, use conditional

  Use prop to passing attribute 'size' and you can control with conditional if the text size

  ```
  @props(['size' => 'base'])

  @php

    $classes = "bg-white/10 hover:bg-white/25 rounded-xl font-bold transition-colors duration-300";

    if($size === 'base')
      $classes.=" px-5 py-1 text-sm";
    
    
    if($size === 'small')
      $classes.=" px-3 py-1 text-2xs";
    

  @endphp
  <a href="" class="{{ $classes }}">{{ $slot }}</a>

  ```

## Create Tables (Migrations)

  Cretae Employer Table as Migration and fill up with 
  UserID, name and logo path

  php artisan make:migration create_employer_table


### Laravel default tables jobs, job_batches, failed_jobs we will rename

  Change default table names of queue jobs, because we want use jobs for our
  eloquent model

  // jobs -> queue_jobs, job_batches -> queue_job_batches, failed_jobs->queued_failed_jobs
  config/queue.php

  And change the migration file name to _queue_jobs_

  0001_01_01_000002_create_queue_jobs_table.php

  And change the table names in the migration file above 

  And migrate:fresh to migrate data tables

  php artisan migrate:fresh

## Create Employer Model, Controller, Factory, Seeder, Policy

  php artisan help make:model

  php artisan make:model Employer -cfs --policy

## Create Job Model, Controller ...

  php artisan make:model Job --all


## Fill Job Migration and migrate

  employer (FK), title, salary, location, schedule (VZ,HZ etc), url, featured (job listing, ranking)


  php artisan migrate

### Employer Model, Relation between Employer and User 

    // Der Arbeitgeber gehört zu einem User und der User hat einen Arbeitgeber, der User
    // tritt hier als Vertreter für den AG auf

    Employer belongs to user and user has one employer

### Job Model, Relation between Job and Employer

    // Ein Job gehört zu einem Arbeitgeber und ein Arbeitgeber hat viele Jobs

    Job belongs to Employer and Employer has many Jobs

### JobFactory and EmployerFactory completed



    


