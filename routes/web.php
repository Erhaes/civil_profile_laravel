<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;

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

// Rute Halaman Utama dan Statis
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profil', [PageController::class, 'profile'])->name('profile');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
Route::get('/unduhan', [PageController::class, 'downloads'])->name('downloads');

// Rute Fasilitas dengan parameter slug dinamis
Route::get('/fasilitas', [PageController::class, 'facilities'])->name('facilities.index');
Route::get('/fasilitas/{slug}', [PageController::class, 'facilityDetail'])->name('facilities.show');

// Rute Pengujian dengan parameter slug dinamis
Route::get('/pengujian', [PageController::class, 'tests'])->name('tests.index');
Route::get('/pengujian/{slug}', [PageController::class, 'testDetail'])->name('tests.show');

// Rute Berita dengan parameter slug dinamis
Route::get('/berita', [PageController::class, 'news'])->name('news.index');
Route::get('/berita/{slug}', [PageController::class, 'newsDetail'])->name('news.show');

// Rute untuk menangani pengiriman formulir kontak
Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit');