<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\ProductFrontController;
use App\Http\Controllers\User\UserFrontController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
Route::get('/admin/login',[AdminController::class, 'showLoginForm'])->name('admin.showLoginForm');
Route::post('/admin/login',[AdminController::class, 'login'])->name('admin.login');
Route::get('/product/show/{id}',[ProductFrontController::class, 'show'])->name('product.show');

Route::middleware('auth')->group(function () {
    // Product    
    Route::get('/product/create',[ProductFrontController::class, 'create'])->name('product.create');
    Route::post('/product/create',[ProductFrontController::class, 'store'])->name('product.store');        
    Route::get('/product/edit/{id}',[ProductFrontController::class, 'edit'])->name('product.edit');
    Route::delete('/product/destroy/{id}',[ProductFrontController::class, 'destroy'])->name('product.destroy');
    Route::put('/product/update/{id}',[ProductFrontController::class, 'update'])->name('product.update');  
    // Route::get('/product/show/{id}',[ProductFrontController::class, 'show'])->name('product.show');

    //profile
    Route::get('user/profile',[UserFrontController::class, 'userProduct'])->name('profile.index');
    Route::get('/profile/show/{id}',[UserFrontController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit/{id}',[UserFrontController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}',[UserFrontController::class, 'update'])->name('profile.update');    
});


Route::group(['middleware' => 'admin.auth', 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    // Category             
    Route::get('/category',[CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create',[CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/create',[CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/destroy/{id}',[CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/edit/{id}',[CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}',[CategoryController::class, 'update'])->name('category.update');

    //Product
    Route::get('/product',[ProductController::class, 'index'])->name('product.index');
    Route::delete('/product/destroy/{id}',[ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/show/{id}',[ProductController::class, 'show'])->name('product.show');
    Route::post('/product/import',[ProductController::class, 'import'])->name('product.import');

    //user
    Route::get('/profile',[UserController::class, 'index'])->name('profile.index');
    Route::get('/profile/create',[UserController::class, 'create'])->name('profile.create');
    Route::post('/profile/create',[UserController::class, 'store'])->name('profile.store');
    Route::get('/profile/show/{id}',[UserController::class, 'show'])->name('profile.show');
    Route::delete('/profile/destroy/{id}',[UserController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/edit/{id}',[UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}',[UserController::class, 'update'])->name('profile.update');
});