<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function index(){
        return view('admin.role.index');
    }
}
