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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//show album create form
Route::get('create-album',[App\Http\Controllers\AlbumController::class,'create'])->name('create.album');

//Handle gallery Store  Request
Route::post('store-gallery',[App\Http\Controllers\AlbumController::class,'createAlbum'])->name('store.album');

////show album edit form
Route::get('edit-album/{id}',[App\Http\Controllers\AlbumController::class,'editAlbum'])->name('edit.album');

//Handle gallery update request 
Route::post('update-album/{id}',[App\Http\Controllers\AlbumController::class,'updateAlbum'])->name('update.album');

//handle gallery delete request 
Route::delete('delete-album/{id}',[App\Http\Controllers\AlbumController::class,'deleteAlbum'])->name('delete.album');




Route::get('single/gallery/{id}',[App\Http\Controllers\GalleryController::class,'index'])->name('show.image');
Route::get('create-image',[App\Http\Controllers\GalleryController::class,'createImage'])->name('create.image');
Route::post('upload-image',[App\Http\Controllers\GalleryController::class,'uploadImage'])->name('store.image');
Route::delete('delete-album/{id}',[App\Http\Controllers\AlbumController::class,'deleteAlbum'])->name('delete.image');