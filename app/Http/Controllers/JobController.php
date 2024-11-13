<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::latest()->with(['employer', 'tags'])->get()->groupBy('featured');
        $tags = Tag::all();
        
        return view('job.index', [
            'featuredJobs' => $jobs[1], 
            'jobs' => $jobs[0], 
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated  = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'schedule' => ['required', Rule::in(['Part Time', 'Full Time'])],
            'featured' => 'nullable',
            'url' => ['required', 'active_url'],
            'tags' => 'nullable|array',
            'tags.*' => 'string',

        ]);

        if($validated['featured']){
            $featured = 1;
        }else{
            $featured = 0;
        }
        
        $job = Auth::user()->employer->jobs()->create([
            'title' => $validated['title'],
            'salary' => $validated['salary'],
            'location' => $validated['location'],
            'schedule' => $validated['schedule'],
            'url' => $validated['url'],
            'featured' => $featured,
        ]);

        if (isset($validated['tags'])) {
            foreach ($validated['tags'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $job->tags()->attach($tag);
            }
        }

        return redirect('/')->with('message', 'Job posted successfully!');
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

    public function fetchTags()
    {
        $tags = Tag::orderBy('created_at', 'desc')->take(5)->get();
        return response()->json($tags);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
