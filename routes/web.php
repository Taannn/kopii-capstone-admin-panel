<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit']);

    Route::get('/categories/{id}/update', [CategoryController::class, 'update']);

    Route::get('/categories/{id}/soft-delete', [CategoryController::class, 'softDelete']);

    Route::get('/categories/{id}/restore', [CategoryController::class, 'restore']);

    Route::get('/categories/{id}/force-delete', [CategoryController::class, 'forceDelete']);

});
