<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    // public function index(){
    //     $empjobs = Job::latest()->with('employer')->
    //     where('employer_id', Auth::user()->employer->id)
    //     ->paginate(10);
    //     return view('employer.index', data: ['empjobs'=> $empjobs]);
    // }

    public function edit(Employer $employer){
        return view('employer.edit', ['employer' => $employer]);
    }

    // public function update()
    // {
    //     return view('employer.edit');
    // }
}
