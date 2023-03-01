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
// Route::get('create-image',[App\Http\Controllers\GalleryController::class,'generateImaged'])->name('create-image');
//Handle gallery Store  Request
Route::post('create-gallery',[App\Http\Controllers\GalleryController::class,'createGallery'])->name('store.gallery');
//Handle gallery edit request 
Route::get('edit-gallery/{id}',[App\Http\Controllers\GalleryController::class,'editGallery'])->name('edit.gallery');
Route::post('update-gallery/{id}',[App\Http\Controllers\GalleryController::class,'updateGallery'])->name('update.gallery');

