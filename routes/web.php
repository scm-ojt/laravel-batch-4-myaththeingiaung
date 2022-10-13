<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/login',[AdminController::class, 'showLoginForm'])->name('admin.showLoginForm');
Route::post('/admin/login',[AdminController::class, 'login'])->name('admin.login');

    // Product             
    Route::get('/product',[ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create',[ProductController::class, 'create'])->name('product.create');
    Route::post('/product/create',[ProductController::class, 'store'])->name('product.store');
    Route::delete('/product/destroy/{id}',[ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product/show/{id}',[ProductController::class, 'show'])->name('product.show');
    Route::get('/product/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}',[ProductController::class, 'update'])->name('product.update');

    Route::resource('profile',UserController::class);


Route::group(['middleware' => 'adminauth', 'prefix' => 'admin', 'as' => 'admin.'], function () {

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
    Route::post('/product/import',[ProductController::class, 'import'])->name('product.import');
    Route::get('/product/export',[ProductController::class, 'export'])->name('product.export');
});