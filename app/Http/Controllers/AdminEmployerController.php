<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminEmployerController extends Controller
{
    public function index()
    {
        return view('admin.employer.index');
    }
}
