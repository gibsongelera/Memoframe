<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FileController;

Route::get('/files', [FileController::class, 'index'])->name('files.index');
Route::post('/upload', [FileController::class, 'upload'])->name('files.upload');
Route::get('/download/{id}', [FileController::class, 'download'])->name('files.download');
Route::delete('/delete/{id}', [FileController::class, 'delete'])->name('files.delete');
Route::get('/delete-all', [FileController::class, 'deleteAll'])->name('files.deleteAll');