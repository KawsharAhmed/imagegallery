<?php

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

Auth::routes();

Route::get('create-gallery',[App\Http\Controllers\GalleryController::class,'create'])->name('create.gallery');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('create-image',[App\Http\Controllers\GalleryController::class,'generateImaged'])->name('create-image');
Route::post('create-image-submit',[App\Http\Controllers\GalleryController::class,'generateImage'])->name('create-image');
