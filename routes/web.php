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

// Home Route for Authenticated Users (redirect based on user type)
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

// Admin Routes 
Route::get('/post_page', [AdminController::class, 'post_page']);

Route::post('/add_post', [AdminController::class, 'add_post']);

Route::get('/show_post', [AdminController::class, 'show_post']);

Route::get('/delete_post/{id}', [AdminController::class, 'delete_post']);

Route::get('/edit_page/{id}', [AdminController::class, 'edit_page']);

Route::post('/update_post/{id}', [AdminController::class, 'update_post']);

Route::get('/post_details/{id}', [HomeController::class, 'post_details'])->name('post.details');

Route::get('/create_post', [HomeController::class, 'create_post'])->middleware('auth');

Route::post('/user_post', [HomeController::class, 'user_post'])->middleware('auth');

Route::get('/my_post', [HomeController::class, 'my_post'])->middleware('auth');

Route::get('/my_post_del/{id}', [HomeController::class, 'my_post_del'])->middleware('auth');

Route::get('/post_update_page/{id}', [HomeController::class, 'post_update_page'])->middleware('auth');

Route::post('/update_post_data/{id}', [HomeController::class, 'update_post_data'])->middleware('auth');

Route::get('/accept_post/{id}', [AdminController::class, 'accept_post']);

Route::get('/reject_post/{id}', [AdminController::class, 'reject_post']);

Route::get('/admin_post', [AdminController::class, 'admin_post'])->middleware('auth');

Route::post('/post/{id}/like', [HomeController::class, 'like'])->name('post.like');

Route::post('/post/{id}/comment', [HomeController::class, 'storeComment'])->name('post.comment');

Route::delete('/comment/delete/{id}', [HomeController::class, 'deleteComment'])->name('comment.delete');

Route::put('/comment/update/{id}', [HomeController::class, 'updateComment'])->name('comment.update');

Route::post('/comment/{comment}/reply', [HomeController::class, 'storeReply'])->middleware('auth')->name('post.comment.reply');

Route::put('/reply/{reply}/edit', [HomeController::class, 'updateReply'])->name('reply.update');

Route::delete('/reply/{reply}', [HomeController::class, 'destroyReply'])->name('comment.reply.delete');

Route::get('/about', [HomeController::class, 'about'])->name('about.page');

Route::get('/blog', [HomeController::class, 'blog'])->name('blog.page');



