<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtWorksController;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/art-works', [ArtWorksController::class, 'index'])->name('art-works.index');
Route::post('/art-works', [ArtWorksController::class, 'store'])->name('art-works.store');
Route::post('/art-works/{id}', [ArtWorksController::class, 'update'])->name('art-works.update');
Route::delete('/art-works/delete/{id}', [ArtWorksController::class, 'destroy'])->name('art-works.destroy');

Route:: get('/books', [BookController::class, 'index']);
Route:: post('/books', [BookController::class, 'store']);
Route:: post('/books/update/{id}', [BookController::class, 'update']);
Route:: delete('/books/delete/{id}', [BookController::class, 'destroy']);