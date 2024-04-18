<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;

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
    return redirect()->route('login');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/products/add', [ProductController::class, 'add'])->name('products.add');

    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');

    Route::get('/products/{id}/soft-delete', [ProductController::class, 'softDelete'])->name('products.softDelete');

    Route::get('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::get('/products/{id}/discount/edit', [ProductController::class, 'edit'])->name('products.edit');

    Route::put('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::put('/products/{id}/discount/update', [ProductController::class, 'update'])->name('products.update');

    Route::get('/products/{id}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/categories/cancel', [CategoryController::class, 'cancel'])->name('categories.cancel');

    Route::get('/categories/{id}/soft-delete', [CategoryController::class, 'softDelete'])->name('categories.softDelete');

    Route::get('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');

    Route::get('/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

});
