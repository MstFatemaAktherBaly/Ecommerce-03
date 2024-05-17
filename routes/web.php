<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Frontend\HomepageController;

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

Route::get('/', [HomepageController::class, 'homepage'])->name('homepage');

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/admin/category', [CategoryController::class, 'category'])->name('category')->middleware('auth');

Route::post('/admin/category', [CategoryController::class, 'categoryInsert'])->name('category.insert')->middleware('auth');

Route::get('/admin/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit')->middleware('auth');

Route::get('/admin/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit')->middleware('auth');

Route::put('/admin/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update')->middleware('auth');

Route::get('/admin/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete')->middleware('auth');



//Routes for Products (Route Grouping)

Route::prefix('/admin/product')->controller(ProductController::class)->name('admin.products.')->middleware('auth')->group(function(){

   Route::get('/', 'addProduct')->name('add');
   Route::POST('/store/{id?}', 'storeProduct')->name('store');

});