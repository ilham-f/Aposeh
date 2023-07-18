<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ObatController;
use App\Http\Controllers\TemplateReplyController;
use App\Http\Controllers\keywordChatController;
use App\Http\Controllers\keywordController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\WebhookController;

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

// Webhook
Route::match(['get', 'post'], '/webhook', [WebhookController::class, 'index']);
Route::post('/kirimchat', [WebhookController::class, 'kirim']);

// User Regis
Route::post('/regis', [RegisterController::class, 'store']);

// Customer Login-Logout
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Google Login
// Route::get('/auth/redirect', [GoogleController::class, 'redirectToGoogle']);
// Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Middleware cek role

// Route::get('/admin', [PegawaiController::class, 'index']);
// Route::get('/tes', [PegawaiController::class, 'tes']);
// Route::get('/form', [PegawaiController::class, 'form']);


Route::get('/admin', [PegawaiController::class, 'index']);
Route::get('/tes', [PegawaiController::class, 'tes']);
Route::get('/form', [PegawaiController::class, 'form']);
// Route::get('/histori', [PegawaiController::class, 'historyChat']);


Route::group(['middleware' => 'auth'], function() {

    // Halaman yang bisa diakses oleh Admin
    Route::group(['middleware' => 'cekrole:manajemen'], function() {
        Route::get('/manajemen', [PegawaiController::class, 'manajemen']);
        // Route::get('/grafik', [PegawaiController::class, 'grafik']);
        Route::get('/pasien', [PegawaiController::class, 'pasien']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        Route::get('/history', [PegawaiController::class, 'history']);
        Route::resource('/Auto-ReplyChat', keywordChatController::class);
        Route::get('/createKeyword', [TemplateReplyController::class, 'create']);
        Route::post('/storeKeyword', [TemplateReplyController::class, 'store']);
        Route::get('/datapegawai', [PegawaiController::class, 'tambahdatapegawai']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        Route::get('/indexdatamember', [MemberController::class, 'index']);
        Route::get('/createmember', [MemberController::class, 'create']);
        Route::post('/creatememberpost', [MemberController::class, 'store']);
    });

    Route::group(['middleware' => 'cekrole:pegawai'], function() {
        Route::get('/pegawai', [PegawaiController::class, 'pegawai']);
        Route::get('/pegawai/member', [PegawaiController::class, 'member']);
    Route::group(['middleware' => 'cekrole:manajemen'], function() {
        Route::get('/manajemen', [PegawaiController::class, 'manajemen']);
        // Route::get('/grafik', [PegawaiController::class, 'grafik']);
        Route::get('/chatmasuk', [PegawaiController::class, 'chatmasuk']);
        Route::get('/pasien', [PegawaiController::class, 'pasien']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        Route::get('/history', [PegawaiController::class, 'history']);
        Route::resource('/Auto-ReplyChat', keywordChatController::class);
        Route::get('/createKeyword', [TemplateReplyController::class, 'create']);
        Route::post('/storeKeyword', [TemplateReplyController::class, 'store']);
        Route::get('/datapegawai', [PegawaiController::class, 'tambahdatapegawai']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        Route::get('/indexdatamember', [MemberController::class, 'index']);
        Route::get('/createmember', [MemberController::class, 'create']);
        Route::post('/creatememberpost', [MemberController::class, 'store']);
    });

    Route::group(['middleware' => 'cekrole:pegawai'], function() {
        Route::get('/pegawai', [PegawaiController::class, 'pegawai']);
        Route::get('/pegawai/member', [PegawaiController::class, 'member']);
        Route::get('/pegawai/createmember', [PegawaiController::class, 'memberPeg']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        Route::get('/charts', [PegawaiController::class, 'charts']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);
        Route::get('/charts', [PegawaiController::class, 'charts']);
        Route::get('/ubahpwd', [UserController::class, 'ubahpw']);

        Route::resource('/pegawai/obat', ObatController::class);
        Route::get('/createObat', [tambahObatController::class, 'create']);
        Route::post('storeObat', [tambahObatController::class, 'store']);
    });

});

// Create, Update, Delete tabel obat
Route::post('/tambahobat', [ObatController::class, 'store'])->name('tambahobat');
Route::put('/tabelobat/{id}', [ObatController::class, 'update']);
Route::delete('/tabelobat/{id}', [ObatController::class, 'destroy']);

// Update User
Route::put('/profil/{id}', [UserController::class, 'update']);
// Update Password User
Route::put('/ubahpw', [UserController::class, 'updatepw']);
