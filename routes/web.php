<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Customer tanpa login

Route::get('/', [LoginController::class, 'index']);
// Route::get('/produk', [ObatController::class, 'index']);
// Route::get('produk/{obat:slug}', [ObatController::class, 'show']);
// Route::get('/categories', [CategoryController::class, 'index']);
// Route::get('categories/{category:slug}', [CategoryController::class, 'show']);

// User Regis
Route::post('/regis', [RegisterController::class, 'store']);

// Customer Login-Logout
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Google Login
// Route::get('/auth/redirect', [GoogleController::class, 'redirectToGoogle']);
// Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Middleware cek role
Route::get('/admin', [PegawaiController::class, 'index']);
Route::get('/tes', [PegawaiController::class, 'tes']);
Route::get('/form', [PegawaiController::class, 'form']);

Route::group(['middleware' => 'auth'], function() {

    // Halaman yang bisa diakses oleh Admin
    Route::group(['middleware' => 'cekrole:manajemen'], function() {
        Route::get('/manajemen', [PegawaiController::class, 'manajemen']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        // Route::get('/tabelobat', [PegawaiController::class, 'tabelobat']);
        // Route::get('/tambahobat', [PegawaiController::class, 'tambahobat']);
        // Route::get('/tabelkategori', [PegawaiController::class, 'tabelkategori']);
        // Route::get('/tambahkategori', [PegawaiController::class, 'tambahkategori']);
        // Route::get('/tabelkeluhan', [PegawaiController::class, 'tabelkeluhan']);
        // Route::get('/tambahkeluhan', [PegawaiController::class, 'tambahkeluhan']);
    });

    Route::group(['middleware' => 'cekrole:pegawai'], function() {
        Route::get('/pegawai', [PegawaiController::class, 'pegawai']);
        Route::get('/pegawai/member', [PegawaiController::class, 'member']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        // Route::get('/tabelobat', [PegawaiController::class, 'tabelobat']);
        // Route::get('/tambahobat', [PegawaiController::class, 'tambahobat']);
        // Route::get('/tabelkategori', [PegawaiController::class, 'tabelkategori']);
        // Route::get('/tambahkategori', [PegawaiController::class, 'tambahkategori']);
        // Route::get('/tabelkeluhan', [PegawaiController::class, 'tabelkeluhan']);
        // Route::get('/tambahkeluhan', [PegawaiController::class, 'tambahkeluhan']);
    });

});

// Create, Update, Delete tabel obat
Route::post('/tambahobat', [ObatController::class, 'store'])->name('tambahobat');
Route::put('/tabelobat/{id}', [ObatController::class, 'update']);
Route::delete('/tabelobat/{id}', [ObatController::class, 'destroy']);

// Create, Update, Delete tabel keluhan
Route::post('/tambahkeluhan', [KeluhanController::class, 'store'])->name('tambahkeluhan');
Route::put('/tabelkeluhan/{id}', [KeluhanController::class, 'update']);
Route::delete('/tabelkeluhan/{id}', [KeluhanController::class, 'destroy']);

// Create, Update, Delete tabel kategori
Route::post('/tambahkategori', [CategoryController::class, 'store'])->name('tambahkategori');
Route::put('/tabelkategori/{id}', [CategoryController::class, 'update']);
Route::delete('/tabelkategori/{id}', [CategoryController::class, 'destroy']);

// Update User
Route::put('/profil/{id}', [UserController::class, 'update']);
// Update Password User
Route::put('/ubahpw', [UserController::class, 'updatepw']);
// Kirim Resep
Route::post('/kirimresep', [ResepController::class, 'store']);

