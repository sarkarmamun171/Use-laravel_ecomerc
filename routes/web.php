<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[HomeController::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Profile
Route::get('/user/profile',[HomeController::class,'user_profile'])->name('user.profile');
Route::post('/user/profile/update',[HomeController::class,'user_profile_update'])->name('user.profile.update');
Route::post('/user/profile/pass_update',[HomeController::class,'user_password_update'])->name('user.password.update');
Route::post('/user/profile/image',[HomeController::class,'user_image_update'])->name('user.image.update');

//User section
Route::get('/user-list',[UserController::class,'user_list'])->name('user.list');

