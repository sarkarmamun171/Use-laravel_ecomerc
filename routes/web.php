<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;

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
Route::get('/user/remove/{user_id}',[UserController::class,'user_remove'])->name('user.remove');

//Category part

Route::get('/category',[CategoryController::class,'category'])->name('category');
Route::post('category/store',[CategoryController::class,'category_store'])->name('category.store');
Route::get('/category/edit{category_id}',[CategoryController::class,'category_edit'])->name('category.edit');
Route::post('/category/update',[CategoryController::class,'category_update'])->name('category.update');
Route::get('/category/soft-delete{category_id}',[CategoryController::class,'category_soft_delete'])->name('category.soft.delete');

//trash
Route::get('/category/trash',[CategoryController::class,'trash'])->name('trash');
Route::get('/category/restore{id}',[CategoryController::class,'category_restore'])->name('category.restore');
Route::get('/category/hard/delete{id}',[CategoryController::class,'category_hard_delete'])->name('category.hard.delete');

//Checked button in delete
Route::post('/category/checked/delete',[CategoryController::class,'category_checked_delete'])->name('category.delete.checked');
Route::post('/restore.checked',[CategoryController::class,'category_restore_checked'])->name('restore.checked');
// Route::get('/category/restore/delete{category_id}',[CategoryController::class,'category_restore_delete'])->name('category.restore.delete');
// Route::get('/category/hard/delete{id}',[CategoryController::class,'category_restore_delete'])->name('category.restore.delete');

//Subcategory
Route::get('/category/subcategory',[SubcategoryController::class,'category_subcategory'])->name('subcategory');
Route::post('/category/subcategory/store',[SubcategoryController::class,'category_subcategory_store'])->name('subcategory.store');
Route::get('/category/subcategory/edit{id}',[SubcategoryController::class,'subcategory_edit'])->name('category.subcategory.edit');
Route::post('/category/subcategory/update{id}',[SubcategoryController::class,'subcategory_update'])->name('category.subcategory.update');
Route::get('/category/subcategory/delete{id}',[SubcategoryController::class,'subcategory_delete'])->name('category.subcategory.delete');

//Brand categories
Route::get('/category/brand',[BrandController::class,'category_brand'])->name('category.brand');
Route::post('/category/brand/store',[BrandController::class,'category_brand_store'])->name('category.brand.store');
Route::get('/category/brand/edit{id}',[BrandController::class,'category_brand_edit'])->name('category.brand.edit');
Route::post('/category/brand/update{id}',[BrandController::class,'category_brand_update'])->name('category.brand.update');
Route::get('category/brand/delete{id}',[BrandController::class,'category_brand_delete'])->name('category.brand.delete');

//product System/Added
Route::get('/product',[ProductController::class,'product'])->name('product');
Route::post('/getSubcategory',[ProductController::class,'getsubcategory']);
Route::post('/product/store',[ProductController::class,'product_store'])->name('product.store');


