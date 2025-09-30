<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

      //  $jobs = Job::all()->groupBy('featured');
        

        // Solution Jeff: Prvent N+1 Problem with "with" eager loading
       // $jobs = Job::latest()->with(['employer','tags'])->get()->groupBy('featured');
       
        // Solution Community: Load all jobs, then load relationships
        // Load all jobs with their employer and tags relationships
        $jobCollection = Job::all()->load('employer','tags');

        [$featured, $recent] = $jobCollection->partition(fn($job) => $job->featured===1);

        //dd($featured, $recent);
        return view('jobs.index', [
            //'jobs' => Job::with('employer','tags')->latest()->paginate(10),
            'jobsFeatured' =>  $featured->sortBy('created_at',descending: true),// Job::with('employer','tags')->latest()->paginate(),
            'jobsRecent' => $recent,
            'tags' => Tag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HttpRequest $request)
    {

        dump($request->all());
       $attribute = $request->validate([
            'title'=>'required',
            'salary'=>'required',
            'location'=>'required',
            'schedule'=>['required',Rule::in(['full-time','part-time','contract'])],
            'url'=>['required','active_url'],  // valid url
            'featured' => 'in:nullable,on,1,0,true,false',
            'tags'=>['nullable'],
        ]); 

        $attribute['featured'] = $request->has('featured')? 1: 0;
        //$attribute['featured'] = $request->boolean('featured') ? 1 : 0;

        // Wir holen uns den angemeldeten User und den zugehörigen Employer, referenzieren dann die Jobs und erstellen einen neuen Job

       
      
        $job = Auth::user()->employer->jobs()->create(Arr::except($attribute, 'tags'));

        /**
         * @todo Refactor $job->tag(...) in Job Model to check for existing tags and avoid duplicates "frontend,front-end"
         */
        if($attribute['tags'] ?? false){
           
            foreach(explode(',', $attribute['tags']) as $tagName){
                
            $job->tag($tagName);
            }
            
        }
        return redirect('/')->with('success','Job created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
