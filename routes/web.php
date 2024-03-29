<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrafficController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // ** PROFILES ** //
    Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profile.edit');
    Route::patch('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/social-link', [ProfileController::class, 'social_link'])->name('add.social-link');
    Route::delete('/profile/social-link/{id}', [ProfileController::class, 'social_link_delete'])->name('delete.social-link');

    // ** GALLERY ** //
    Route::resource('gallery', GalleryController::class)->except('index');
    Route::get('gallery/{slug}/download', [GalleryController::class, 'download'])->name('gallery.download');

    // ** LIKE ** //
    Route::post('gallery/{gallery}/like', [LikeController::class, 'like'])->name('like');

    // ** COMMENT ** //
    Route::resource('comment', CommentController::class);

    // ** ADMINISTRATOR ** //
    Route::middleware('admin')->prefix('dashboard')->group(function () {
        // Gallery Management
        Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::patch('gallery/{slug}/ban', [GalleryController::class, 'banned'])->name('gallery.banned');
        // User Management
        Route::resource('users', UserController::class);
        // Traffic & Generate Report
        Route::get('traffic', [TrafficController::class, 'index'])->name('traffic');
    });
});

Auth::routes();
