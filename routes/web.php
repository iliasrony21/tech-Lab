<?php

use App\Http\Controllers\ImageController;
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
// Multi Images Ajax Crud All Route
Route::get('/get_images', [ImageController::class, 'index'])->name('show_images');
Route::get('/get_images_ajax', [ImageController::class, 'getAjaxImage'])->name('show_images_ajax');
Route::get('/create_image', [ImageController::class, 'create'])->name('create_images');
Route::post('/store_image', [ImageController::class, 'store']);
Route::get('/images/{id}', [ImageController::class, 'show']);
Route::get('/edit/{id}', [ImageController::class, 'edit'])->name('images.edit');
Route::put('/update/{id}', [ImageController::class, 'update']);
Route::delete('/delete_image/{id}', [ImageController::class, 'destroy']);
