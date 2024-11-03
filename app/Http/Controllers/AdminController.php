<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $count = [
            'total_jobs' => Job::count(),
            'total_featured_jobs' => Job::where('featured', 1)->count(),
            'total_employers' => Employer::count()
        ];
        return view('admin.index',['count' => $count]);
    }

}
