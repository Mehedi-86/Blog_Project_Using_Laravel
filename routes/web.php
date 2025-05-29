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
    Route::get('/admin/home', [HomeController::class, 'homepage'])->name('admin.home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/connections', [HomeController::class, 'connections'])->name('connections');
    // other protected routes
});

// Home Route for Authenticated Users (redirect based on user type)
Route::get('/home', [HomeController::class, 'homepage'])->middleware('auth')->name('home');

// Admin Routes 

Route::get('/show_post', [AdminController::class, 'show_post']);

Route::get('/delete_post/{id}', [AdminController::class, 'delete_post']);

Route::get('/edit_page/{id}', [AdminController::class, 'edit_page']);

Route::post('/update_post/{id}', [AdminController::class, 'update_post']);

Route::get('/admin_profile', [AdminController::class, 'adminProfile'])->name('admin.profile')->middleware('auth');

Route::post('/admin/profile/picture/update', [AdminController::class, 'updatePicture'])->name('admin.profile.picture.update')->middleware('auth');

Route::get('/admin/home', [AdminController::class, 'adminHome'])->name('admin.home');

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

Route::post('/increase-view/{id}', [HomeController::class, 'increase_view']);

Route::get('/profile/{id}', [HomeController::class, 'profile'])->name('user.profile');

Route::get('/profile/picture', [HomeController::class, 'showPictureForm'])->name('profile.picture.form');

Route::post('/profile/picture', [HomeController::class, 'updatePicture'])->name('profile.picture.update');

Route::post('/posts/{post}/save-toggle', [HomeController::class, 'toggleSave'])->name('posts.toggleSave');

Route::get('/connections', [App\Http\Controllers\HomeController::class, 'connections'])->name('connections');

Route::post('/follow/{id}', [App\Http\Controllers\HomeController::class, 'follow'])->name('follow');

Route::post('/unfollow/{id}', [App\Http\Controllers\HomeController::class, 'unfollow'])->name('unfollow');

Route::get('/user/{id}/details', [HomeController::class, 'userDetails'])->name('user.details');

Route::post('/user/add/work', [HomeController::class, 'addWorkExperience'])->name('user.add.work');

Route::post('/add-education', [HomeController::class, 'addEducation'])->name('user.add.education');

Route::post('/update-address', [HomeController::class, 'updateAddress'])->name('user.update.address');

Route::post('/update-basic-info', [HomeController::class, 'updateBasicInfo'])->name('user.update.basicinfo');

Route::post('/profile/update-contact', [App\Http\Controllers\HomeController::class, 'updateContactInfo'])->name('profile.update.contact');

Route::post('/profile/activity/add', [HomeController::class, 'addActivity'])->name('activity.add');

Route::post('/profile/activity/{id}/update', [HomeController::class, 'updateActivity'])->name('activity.update');

Route::delete('/profile/activity/{id}/delete', [HomeController::class, 'deleteActivity'])->name('activity.delete');

Route::post('/profile/work/{id}/update', [HomeController::class, 'updateWork'])->name('user.work.update');

Route::delete('/profile/work/{id}/delete', [HomeController::class, 'deleteWork'])->name('user.work.delete');

Route::post('/profile/education/{id}/update', [HomeController::class, 'updateEducation'])->name('user.education.update');

Route::delete('/profile/education/{id}/delete', [HomeController::class, 'deleteEducation'])->name('user.education.delete');

Route::delete('/user/delete-address', [HomeController::class, 'deleteAddress'])->name('user.delete.address');

Route::delete('/profile/delete/contact', [HomeController::class, 'deleteContact'])->name('profile.delete.contact');

Route::delete('/profile/basicinfo/delete', [HomeController::class, 'deleteBasicInfo'])->name('user.delete.basicinfo');

Route::get('/user/view/{id}', [HomeController::class, 'userView'])->name('user.view');

Route::get('/user/view-details/{id}', [HomeController::class, 'viewUserDetails'])->name('user.viewDetails');

Route::get('/switch-to-user-home', [HomeController::class, 'switchToUserHomepage'])->name('switch.user.home');
