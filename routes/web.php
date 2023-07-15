<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BiayaPenyimpananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('daftar-supplier', [SupplierController::class, 'index']);
    Route::get('tambah-supplier', [SupplierController::class, 'create']);
    Route::post('post-supplier', [SupplierController::class, 'store']);
    Route::get('edit-supplier/{supplier}', [SupplierController::class, 'edit']);
    Route::post('update-supplier/{supplier}', [SupplierController::class, 'update']);
    Route::get('delete-supplier/{supplier}', [SupplierController::class, 'destroy']);

    Route::get('daftar-kategori', [KategoriController::class, 'index']);
    Route::get('tambah-kategori', [KategoriController::class, 'create']);
    Route::post('post-kategori', [KategoriController::class, 'store']);
    Route::get('edit-kategori/{kategori}', [KategoriController::class, 'edit']);
    Route::post('update-kategori/{kategori}', [KategoriController::class, 'update']);
    Route::get('delete-kategori/{kategori}', [KategoriController::class, 'destroy']);

    Route::get('daftar-barang', [BarangController::class, 'index']);
    Route::get('tambah-barang', [BarangController::class, 'create']);
    Route::post('post-barang', [BarangController::class, 'store']);
    Route::get('edit-barang/{barang}', [BarangController::class, 'edit']);
    Route::post('update-barang/{barang}', [BarangController::class, 'update']);
    Route::get('delete-barang/{barang}', [BarangController::class, 'destroy']);

    Route::get('daftar-barang-masuk', [BarangMasukController::class, 'index']);
    Route::get('tambah-barang-masuk', [BarangMasukController::class, 'create']);
    Route::post('post-barang-masuk', [BarangMasukController::class, 'store']);
    Route::get('edit-barang-masuk/{barangMasuk}', [BarangMasukController::class, 'edit']);
    Route::post('update-barang-masuk/{barangMasuk}', [BarangMasukController::class, 'update']);
    Route::get('delete-barang-masuk/{barangMasuk}', [BarangMasukController::class, 'destroy']);

    Route::get('daftar-barang-keluar', [BarangKeluarController::class, 'index']);
    Route::get('tambah-barang-keluar', [BarangKeluarController::class, 'create']);
    Route::post('post-barang-keluar', [BarangKeluarController::class, 'store']);
    Route::get('detail-barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'show']);
    Route::get('edit-barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'edit']);
    Route::post('update-barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'update']);
    Route::get('delete-barang-keluar/{barangKeluar}', [BarangKeluarController::class, 'destroy']);

    Route::get('daftar-perhitungan', [PerhitunganController::class, 'index']);

    Route::get('daftar-biaya', [BiayaPenyimpananController::class, 'index']);
    Route::get('tambah-biaya', [BiayaPenyimpananController::class, 'create']);
    Route::post('post-biaya', [BiayaPenyimpananController::class, 'store']);
    Route::get('edit-biaya/{biaya}', [BiayaPenyimpananController::class, 'edit']);
    Route::post('update-biaya/{biaya}', [BiayaPenyimpananController::class, 'update']);
    Route::get('delete-biaya/{biaya}', [BiayaPenyimpananController::class, 'destroy']);

    Route::get('daftar-report', [PerhitunganController::class, 'reportPerhitungan']);
    Route::post('post-report', [PerhitunganController::class, 'reportPerhitungan']);

    Route::get('daftar-users', [UserController::class, 'index']);
    Route::get('tambah-users', [UserController::class, 'create']);
    Route::post('post-users', [UserController::class, 'store']);
    Route::get('edit-users/{user}', [UserController::class, 'edit']);
    Route::post('update-users/{user}', [UserController::class, 'update']);
    Route::get('delete-users/{user}', [UserController::class, 'destroy']);
    Route::get('reset-password/{user}', [UserController::class, 'resetPassword']);
    Route::get('change-password', [UserController::class, 'changePassword']);
    Route::post('changed-password/{id}', [UserController::class, 'changedPassword']);
});


Route::get('login', function () {
    return view('pages.login');
});

Route::get('logout', function () {
    Auth::logout();

    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
