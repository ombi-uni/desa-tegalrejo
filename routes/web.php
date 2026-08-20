<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatisticPageController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/belanja', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/belanja/{slug}', [UmkmController::class, 'show'])->name('umkm.show');
Route::get('/transparansi', [BudgetController::class, 'index'])->name('budget.index');
Route::get('/transparansi/{budget}/download', [BudgetController::class, 'download'])->name('budget.download');
Route::get('/transparansi/doc/{category}', [BudgetController::class, 'downloadDoc'])->name('budget.doc.download');
Route::get('/kependudukan', [StatisticPageController::class, 'index'])->name('kependudukan.index');
