<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // Albums Routes
    Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
    Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
    Route::post('/albums/{album}/upload', [AlbumController::class, 'upload'])->name('albums.upload');
    Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
    Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
    Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
    Route::delete('/albums/{album}', [AlbumController::class, 'delete'])->name('albums.delete');
    Route::patch('/albums/{album}/move-images/{targetAlbum}', [AlbumController::class, 'moveImages'])->name('albums.moveImages');

    // image Routes
    Route::get('/albums/{album}/image', [ImageController::class, 'index'])->name('image.index');
    Route::get('/albums/{album}/image/create', [ImageController::class, 'create'])->name('image.create');
    Route::post('/albums/{album}/image', [ImageController::class, 'store'])->name('image.store');
    Route::put('/albums/{album}/image/{image}', [ImageController::class, 'update'])->name('image.update');

    Route::get('/albums/{album}/image/{image}/edit', [ImageController::class, 'edit'])->name('albums.image.edit');
    Route::put('/albums/{album}/image/{image}', [ImageController::class, 'update'])->name('albums.image.update');

    Route::delete('/albums/{album}/image/{image}', [ImageController::class, 'destroy'])->name('image.destroy');
});

require __DIR__.'/auth.php';
