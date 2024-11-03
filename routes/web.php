<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminEmployerController;
use App\Http\Controllers\AdminEmployerJobsController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobSearchController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\PositionMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Livewire\JobManager;
use App\Livewire\JobView;
use App\Livewire\TestLiveWire;
use App\Livewire\UserView;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index']);
Route::get('/search', JobSearchController::class);
Route::get('/tags/{tag:name}', TagController::class);
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('signupForm');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create'])->name('loginForm');
    Route::post('/login', [LoginController::class, 'store'])->name('login');
});

Route::delete('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/emp-job-view', [EmployerController::class, 'index']);
});

Route::middleware(['auth', 'PositionMiddleware:admin,editor'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/users', UserView::class);
    Route::get('/jobs', JobView::class);
    Route::get('/employers', [AdminEmployerController::class, 'index']);
    Route::get('/roles', [AdminRoleController::class, 'index']);
});

Route::middleware(['auth', PositionMiddleware::class.":admin"])->prefix('admin')->group(function () {
    Route::get('/users/{id}/delete', [AdminUserController::class, 'destroy']);
    Route::get('/employers/{id}/delete', [AdminEmployerController::class, 'index']);
    Route::get('/jobs/{id}/delete', [AdminEmployerJobsController::class, 'index']);
    Route::get('/roles/{id}/delete', [AdminEmployerJobsController::class, 'index']);
});


Route::get('/livewire', TestLiveWire::class);
