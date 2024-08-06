<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuuController;
use App\Http\Controllers\KategoriBukuController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

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
    return view('sign.login');
});
Route::get('/login', function () {
    return view('sign.login');
});

Route::get('/register', function () {
    return view('sign.register');
});
Route::get('/utama', function () {
    return view('halaman.utama');
});

Route::get('buku', [BukuuController::class, 'buku'])->name('halaman.buku');
Route::post('buku', [BukuuController::class, 'store'])->name('halaman.buku.store');
Route::get('buku/{id}', [BukuuController::class, 'detail'])->name('halaman.buku.detail');

Route::get('kategoribuku', [KategoriBukuController::class, 'index'])->name('halaman.kategoribuku');
Route::post('kategoribuku', [KategoriBukuController::class, 'store'])->name('halaman.kategoribuku.store');
Route::get('kategoribuku/{id}', [KategoriBukuController::class, 'detail'])->name('halaman.kategoribuku.detail');

// Rute untuk daftar admin
Route::get('/admin', [AdminController::class, 'admin'])->name('halaman.admin');
Route::get('/add_admin', [AdminController::class, 'create'])->name('add_admin');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
// Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
// Route::post('/admin', [AdminController::class, 'store'])->name('halaman.admin.store');