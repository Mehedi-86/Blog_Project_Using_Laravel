<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Import Auth
use App\Http\Controllers\HomeController;
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
// Define the homepage route with a name
Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

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
    Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home');
});

// Home Route Redirection
Route::get('/home', function () {
    if (Auth::check()) {
        return Auth::user()->usertype === 'admin' 
            ? redirect()->route('admin.home') 
            : redirect()->route('homepage');
    }
    return redirect('/');
})->name('home');

Route::get('/post_page', [AdminController::class, 'post_page']);

Route::post('/add_post', [AdminController::class, 'add_post']);

Route::get('/show_post', [AdminController::class, 'show_post']);

Route::get('/delete_post/{id}', [AdminController::class, 'delete_post']);

Route::get('/edit_page/{id}', [AdminController::class, 'edit_page']);

Route::post('/update_post/{id}', [AdminController::class, 'update_post']);