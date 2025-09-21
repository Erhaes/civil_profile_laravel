<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;

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
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/profil', [ProfileController::class, 'profile'])->name('profile');
Route::get('/kontak', [ContactController::class, 'contact'])->name('contact');
Route::get('/unduhan', [DownloadController::class, 'downloads'])->name('downloads');

// Rute Fasilitas dengan parameter slug dinamis
Route::get('/fasilitas', [FacilityController::class, 'facilities'])->name('facilities.index');
Route::get('/fasilitas/{slug}', [FacilityController::class, 'facilityDetail'])->name('facilities.show');

// Rute Pengujian dengan parameter slug dinamis
Route::get('/pengujian', [TestController::class, 'tests'])->name('tests.index');
Route::get('/pengujian/{slug}', [TestController::class, 'testDetail'])->name('tests.show');

// Rute Berita dengan parameter slug dinamis
Route::get('/berita', [NewsController::class, 'news'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'newsDetail'])->name('news.show');

// Rute untuk menangani pengiriman formulir kontak
Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit');

// Rute untuk grouping team
Route::get('/api/team-data', [ProfileController::class, 'fetchTeamData'])->name('api.team-data');