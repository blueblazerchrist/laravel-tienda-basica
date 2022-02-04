<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ImageViewerController;
use App\Http\Controllers\Product\ProductController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('categories', CategoryController::class)->except('show');
Route::resource('products', ProductController::class);
Route::get('image-viewer/{imageName}', [ImageViewerController::class, '__invoke']);
