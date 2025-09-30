<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $search = $request->input('q');

        //$search = request('q');
       
        $jobs = Job::query()
            ->with(['employer','tags'])
            ->where('title', 'like', "%{$search}%")
            // ->orWhere('description', 'like', "%{$search}%")
            // ->orWhere('company', 'like', "%{$search}%")
            ->get();

        return view('results', ['jobs' => $jobs]);
    }
}
