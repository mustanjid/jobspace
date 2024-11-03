<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class AdminEmployerJobsController extends Controller
{
    public function index()
    {
        $empjobs = Job::latest()->with('employer')
            ->paginate(10);
        return view('admin.job.index', ['empjobs' => $empjobs]);
    }

    public function edit(Job $job)
    {
        return view('admin.job.edit', compact('job'));
    }
}
