<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Import Auth
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Public Route (Homepage)
Route::get('/', function () {
    return view('welcome');
});

// Protected Routes (Require Authentication)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // User Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin Home Page
    Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
});

// Home Route Redirection
Route::get('/home', function () {
    if (Auth::check()) {
        return Auth::user()->usertype === 'admin' 
            ? redirect()->route('admin.home') 
            : redirect()->route('dashboard');
    }
    return redirect('/');
})->name('home');
