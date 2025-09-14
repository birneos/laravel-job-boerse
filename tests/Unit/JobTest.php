<?php

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Sequence;

it('belongs to an employer', function () {

    // AAA - Arrange, Act, Assert
    // Arrange: We arrange a Testworld, Create an employer and a job associated with that employer
    // Act: Performs a action, Check if the job belongs to the employer
    // Assert: What do you expect to happen? Verify the relationship

    // Create an employer using a factory
    $employer = \App\Models\Employer::factory()->create();

    // Create a job using a factory and associate it with the employer
    // The job should have an 'employer_id' that matches the created employer's ID
    $job = \App\Models\Job::factory()->create([
        'employer_id' => $employer->id,
    ]);

    // Act and Assert: Check if the job's employer relationship is correct
    expect($job->employer()->is($employer))->toBeTrue();
});


it('can have tags', function () {
    // Arrange: Create a job using a factory
    $job = \App\Models\Job::factory()->create();

    $job->tag("Laravel");

    expect($job->tags)->toHaveCount(1);
});


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