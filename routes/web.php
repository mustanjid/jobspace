<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobSearchController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PositionContoller;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\PositionMiddleware;
use App\Livewire\EmpJobManager;
use App\Livewire\EmployerView;
use App\Livewire\JobView;
use App\Livewire\UserJobView;
use App\Livewire\UserView;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index']);
Route::get('/all-jobs', UserJobView::class);

Route::get('/employers/{employer:id}', [EmployerController::class, 'edit']);
// Route::post('/update-employer', [EmployerController::class, 'update']);

// Route::get('/search', JobSearchController::class);

Route::get('/tags/{tag:name}', TagController::class);
Route::get('/tags', [JobController::class, 'fetchTags'])->middleware('auth');
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
    Route::get('/emp-job-view', EmpJobManager::class);
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/users', UserView::class);
    Route::get('/jobs', JobView::class);
    Route::get('/employers', EmployerView::class);
});


Route::get('admin/roles', [PositionContoller::class, 'list']);
Route::get('admin/roles/add', [PositionContoller::class, 'add']);
Route::post('/admin/roles/add', [PositionContoller::class, 'insert']);
Route::get('admin/roles/edit/{id}', [PositionContoller::class, 'edit']);
Route::post('admin/roles/edit/{id}', [PositionContoller::class, 'update']);
Route::post('admin/roles/delete/{id}', [PositionContoller::class, 'delete']); 