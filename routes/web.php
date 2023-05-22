<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::controller(ProductController::class)->middleware('auth')->prefix('products')->group(function () {
    Route::get('/{product}', 'show')->name('products_show');
    Route::post('/', 'store')->name('products_store');
    Route::put('/{product}', 'update')->name('products_update');
    Route::delete('/{product}', 'destroy')->name('products_destroy');
    Route::get('/', 'index')->name('products_index');
});

Route::controller(OrderController::class)->middleware('auth')->prefix('orders')->group(function () {
    Route::get('/own', 'index')->name('orders_index');
    Route::get('/{user}', 'show')->name('orders_show');
    Route::post('/{order}', 'finish')->name('orders_finish');
    Route::post('/', 'store')->name('orders_store');
    Route::put('/{order}/{orderitem}', 'updateItem')->name('order_items_update');
    Route::put('/', 'update')->name('orders_update');
    Route::delete('/{order}/{orderitem}', 'destroyItem')->name('order_items_destroy');
    Route::delete('/{order}', 'destroy')->name('orders_destroy');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
