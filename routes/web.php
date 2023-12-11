<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SuppliersController;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
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


/**
 * Admin Routes
 * adding prefix of admin to all admin routes
 */
Route::prefix('/admin')->group(function(){
    Route::get('/dashboard', [HomeController::class, 'index']);

    // add an other prefix for products and create routes for that
    Route::prefix('/products')->group(function(){
        Route::get('/', [ProductsController::class, 'index'])->name('all.products'); // reverse route
        Route::get('/create', [ProductsController::class, 'create'])->name('create.product');
        Route::post('/store', [ProductsController::class, 'store'])->name('store.product');
        Route::put('/{id}/update', [ProductsController::class, 'update'])->name('update.product');
        Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('edit.product');
        Route::delete('/{id}/trash', [ProductsController::class, 'destroy'])->name('destroy.product'); // this route is used in Ajax for moving item to trash
        //Route::delete('/{id}/delete', [ProductsController::class, 'delete'])->name('delete.product'); // this route is used in Ajax for moving item to trash
    });

    // stock routes with [stock] prefix, reverse routing is used
    Route::prefix('/stock')->group(function() {
        Route::get('/', [StockController::class, 'index'])->name('all.stock');
        Route::get('/create', [StockController::class, 'create'])->name('create.stock');
        Route::post('/store', [StockController::class, 'store'])->name('store.stock');
        Route::post('/{id}/update', [StockController::class, 'update'])->name('update.stock'); // using post route to create new entry instead of updating previous
        Route::get('/{id}/edit', [StockController::class, 'edit'])->name('edit.stock');
        Route::delete('/{id}/trash', [StockController::class, 'destroy'])->name('destroy.stock');
        Route::post('/get-form-fields', [StockController::class, 'stockEntryForm'])->name('form-fields.stock');
    });

    // categories route
    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('all.categories');
        Route::post('/store', [CategoriesController::class, 'store'])->name('store.category');
        Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('edit.category');
        Route::delete('/{id}/delete', [CategoriesController::class, 'destroy'])->name('destroy.category');
        Route::put('/{id}/update', [CategoriesController::class, 'update'])->name('update.category');
    });

    // Supplier routes
    Route::prefix('/suppliers')->group(function() {
        Route::get('/', [SuppliersController::class, 'index'])->name('all.suppliers');
        Route::post('/store', [SuppliersController::class, 'store'])->name('store.supplier');
        Route::put('/{id}/update', [SuppliersController::class, 'update'])->name('update.supplier');
        Route::get('/{id}/edit', [SuppliersController::class, 'edit'])->name('edit.supplier');
        Route::delete('/{id}/delete', [SuppliersController::class, 'destroy'])->name('destroy.supplier');
    });

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
