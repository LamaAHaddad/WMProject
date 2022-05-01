<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::prefix('cms/admin')->group(function(){
//     Route::get('login',[AuthController::class,'showLoginView'])->name('cms.login');
//     Route::post('login',[AuthController::class,'login']);
// });

Route::prefix('cms/admin')->group(function(){
    Route::view('/','cms.temp');
    Route::resource('cities', CityController::class);
    Route::resource('users',UserController::class);
    Route::resource('admins',AdminController::class);
    Route::resource('stocks',StockController::class);
    Route::resource('cars',CarController::class);
    Route::resource('products',ProductController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('sub_categories',SubCategoryController::class);
    Route::resource('invoices',InvoiceController::class);
    // Route::resource('distributors',DistributorController::class);
});
