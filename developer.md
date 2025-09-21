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


# Test with Pest (Wrapper um PHPUnit)

## Install Pest

  // Install Pest
   composer require pestphp/pest --dev

   // If we are using Larvavel install Laravel Plugin
   composer require pestphp/pest-plugin-laravel --dev

  // Initialiize Pest
   ./vendor/bin/pest --init

## Configure Pest

   Featue and Unit Folder added to scan for tests and uncomment "RefreshDatabase", after every 
   test, database will refreshed, we want that Feature and Unit for testing

   Pest.php

   ```
    pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature','Unit');
   ```

## Configure phpunit.xml

   You can configure to use Database instead Memory for testing or a Mailer like SMTP instead an array.

## Difference Feature or Unit Test

  Feature = wide spectrum of test, like browsertest or controller input validation, database 

  Unit = small spectrum of a test

## Create First Test
  // Feature Test
  php artisan make:test

### AAA Principle in Tests - Arrange, Act, Assert

   // AAA - Arrange, Act, Assert
      Every Test should have AAA

    // Arrange: We arrange a Testworld
      i.e. Create an employer and a job associated with that employer

    // Act: Performs a action
      i.e. Check if the job belongs to the employer

    // Assert: What do you expect to happen? 
      i.e. Verify the relationship


## TestDriven approach, create my World and code it

    create my fantasy world, job can have tags. Add Tag ($job->tag) and check whether
    $job->tags have 1 element. Code still doesnt exist, step by step we create our real world

    ```
    it('can have tags', function () {
        // Arrange: Create a job using a factory
      $job = \App\Models\Job::factory()->create();

      tag doesnt exist in code, test will show error and we code it
      $job>tag('Frontend');

      tags collection doesnt exist, test will show two errors so we code it
      first: the function tags doesnt exists
      second: no relation exist for job to tags

      Solution:
      first: create function that return array or collection
      second: create Tag Model,Factory and Migration with php artisan make:model Tag -fm
    
      expect($job->tags)->toHaveCount(1);
    });
    ```

### Tag Model, Factory and Migration

#### create Tag Model, Factory, Migration
      
      php artisan make:model Tag -fm

#### create Job <-> Tags Relation

    A job can have many tags and a tag can have many jobs

      Job Model

      public function Tag(){
        return $this->belongsToMany(Tag::class);
      }

#### create pivot table job_tag , so job and tag ids can related


      php artisan make:migration create_job_tag_table

      ```
      public function up(): void
      {
          Schema::create('job_tag', function (Blueprint $table) {
              $table->id();
              $table->foreignIdFor(Job::class)->constrained()->cascadeOnDelete();    // if job deleted, cascade and delete also datasets with job id
              $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();    // if tag deleted, cascade and delete also datasets with tag id
              // Additional fields can be added here if needed
              $table->timestamps();
          });
      }
      ```
    
    php artisan migrate
#### php artisan test failed with "Add [name] to fillable property to allow mass assignment on [App\Models\Tag]

  2 Solutions

  1. add fillable to  Tag class
  2. general deactivate in AppServiceProvider, more see ../basicproject

    ```
      /**
      * Bootstrap any application services.
      */
      public function boot(): void
      {
          Model::unguard()
      }
    ```

#### Featured + Recent Jobs in JobController

  We need Jobs with featured (hervorgehoben)

   ``` 
    //JobController.php

    $jobCollection = Job::all()->load('employer','tags');

        [$featured, $recent] = $jobCollection->partition(fn($job) => $job->featured===1);
  ```

  Create Unit Test in JobTest.php

  ```
  it('is featured', function()
    {
        $sequence = new Sequence(['featured'=>false, 'schedule'=>'Full Time']
        ,['featured'=>true, 'schedule'=>'Full Time']
        );

            $tags = Tag::factory(3)->create();
            Job::factory(5)->hasAttached($tags)->create($sequence);

        $jobs = Job::all()->groupBy('featured');
        expect($jobs[0][0]->featured==1)->toBeTrue();
    });
  ```

## Authentication

   Create Login + Register Routes+Controller

   php artisan make:controller SessionController --resource
   php artisan make:controller SessionController --resource

### Views + Forms

  Import Blade Elements Form, Buttons, Label, Inputs by Jeffrey Ways Github https://github.com/laracasts/pixel-position

  Copied to /resources/views/components/forms

#### Register.blade.php

  Create Register Form

  Import for FileUpload, to Add to form enctype="multipart/form-data" for fileupload "Logo", only then
  we get the upload as object

#### RegisteredUserController

  Register Form send Data to store Data

  Validate User data and Employer Data  !!! EVER VALIDATE

    ```
          $userAttributes = $request->validate([ 
        'name'=>['required','min:3'],
        'email'=>[  'required','email','unique:users,email','max:254'],
        'password'=>['required','confirmed',Password::min(6)],
        'password_confirmation'=>['required','same:password']
        ]);


      // 2: Validate Employer

      $employerAttributes = $request->validate([
        'name'=>['required'],
        'logo'=>['required',File::types(['png','jpg','webp'])->max(5*1024)],
       
      ]);
    ```

  Create User, Save Logo and  assign Employer Data to new User

    ```
      $user = User::create($userAttributes);

      $request->logo->store('logo','public');  // store in storage/app/public/logo

      // Assign Employer to User
      $user->employer()->create([
            'name'=>$employerAttributes['name'],
            'logo'=>$path
        ]);

    ```


  Login Registred User + redirect to homepage

    ```
    
    ```


  


###  Filesystem, determine where i store my data - local, public folder, s3 etc.

    config/filesystems you see where you can save files by upload 

    change in .env from local to public
     FILESYSTEM_DISK=public

    data will the stored in storage/app/public/logo and we create later a symbolic link to the /public folder

# Troubleshooting

  SQLSTATE[HY000] [2002] php_network_getaddresses: getaddrinfo for db failed: Temporary failure in name resolution (Connection: mariadb, SQL: select exists (select 1 from information_schema.tables where table_schema =   schema() and table_name = 'migrations' and table_type in ('BASE TABLE', 'SYSTEM VERSIONED')) as exists)

   docker compose exec php php artisan optimize    
   docker compose exec php php artisan config:cache

## Running Test

  php artisan test





    


