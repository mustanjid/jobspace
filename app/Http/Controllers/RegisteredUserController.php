<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate both user and employer data
        $data = $request->validate([
            // User validation rules
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::min(6)],

            // Employer validation rules
            'employer' => ['required'],
            'logo' => ['required', 'file', 'max:512', File::types(['jpeg', 'jpg', 'png', 'webp'])],
        ]);

        DB::transaction(function () use ($data, $request) {
            // Create the user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'status' => 0
            ]);

            // Save the logo and get the path
            $logoPath = $request->logo->store('logos');

            // Create the employer associated with the user
            $user->employer()->create([
                'name' => $data['employer'],
                'logo' => $logoPath,
            ]);

            // Automatically log in the user
            Auth::login($user);
        });

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
