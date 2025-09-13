<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\KategoriController;

Route::get('/', [SuratController::class, 'index'])->name('surat.index');
Route::get('/surat/download/{id}', [SuratController::class, 'download'])->name('surat.download');
Route::resource('surat', SuratController::class)->except(['index']);
Route::resource('kategori', KategoriController::class);
Route::view('/about', 'about')->name('about');
