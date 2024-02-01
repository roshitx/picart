<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

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
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/social-link', [ProfileController::class, 'social_link'])->name('add.social-link');

    // ** GALLERY ** //
    Route::resource('gallery', GalleryController::class);
    
    // ** ADMINISTRATOR ** //
    Route::middleware('admin')->prefix('dashboard')->group(function () {
        // User Management
        Route::resource('users', UserController::class);
    });
});

Auth::routes();
