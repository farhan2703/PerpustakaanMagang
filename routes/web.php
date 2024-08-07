<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PeminjamanPengembalianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route untuk menampilkan form register
Route::get('/register', function () {
    return view('sign.register');
})->name('register');

// Route untuk mengirimkan form register
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Route untuk logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth:admin');

Route::get('/member/dashboard', function () {
    return view('member.dashboard');
})->name('member.dashboard')->middleware('auth:member');

Route::get('/member/dashboard', function () {
    return view('halaman.member');
})->name('halaman.member');


// Halaman utama
Route::get('/', function () {
    return view('auth.login');
})->name('home');

// Buku routes
// Route untuk import Excel
Route::post('/importbuku', [BukuuController::class, 'bukuimportexcel'])->name('import-buku');
Route::get('/buku', [BukuuController::class, 'buku'])->name('halaman.buku');
Route::get('/addbuku', [BukuuController::class, 'create'])->name('addbuku');
Route::post('/buku', [BukuuController::class, 'store'])->name('halaman.buku.store');
Route::get('/buku/{id}', [BukuuController::class, 'detail'])->name('halaman.buku.detail');
Route::get('/buku/edit/{id}', [BukuuController::class, 'edit'])->name('halaman.buku.edit');
Route::put('/buku/update/{id}', [BukuuController::class, 'update'])->name('halaman.buku.update');
Route::delete('/buku/{id}', [BukuuController::class, 'forcedelete'])->name('buku.forcedelete');

// Kategori Buku routes
Route::get('kategoribuku', [KategoriBukuController::class, 'index'])->name('halaman.kategoribuku');
Route::get('/addkategoribuku', [KategoriBukuController::class, 'create'])->name('addkategoribuku');
Route::post('/kategoribuku', [KategoriBukuController::class, 'store'])->name('halaman.kategoribuku.store');
Route::get('kategoribuku/{id}', [KategoriBukuController::class, 'detail'])->name('halaman.kategoribuku.detail');
Route::get('/kategoribuku/{id_kategori}/edit', [KategoriBukuController::class, 'edit'])->name('halaman.kategoribuku.edit');
Route::put('/kategoribuku/{id_kategori}', [KategoriBukuController::class, 'update'])->name('kategoribuku.update');

// Admin routes
Route::get('/admin', [AdminController::class, 'admin'])->name('halaman.admin');
Route::get('/add_admin', [AdminController::class, 'create'])->name('add_admin');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [AdminController::class, 'forcedelete'])->name('admin_forcedelete');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Member dashboard route
Route::get('/member/dashboard', [MemberController::class, 'dashboard'])->name('member.dashboard');
Route::get('/member', [MemberController::class, 'index'])->name('halaman.member');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Peminjaman routes
Route::get('/peminjaman', [PeminjamanPengembalianController::class, 'indexPeminjaman'])->name('halaman.peminjaman');
Route::get('/peminjaman/create', [PeminjamanPengembalianController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman', [PeminjamanPengembalianController::class, 'store'])->name('peminjaman.store');
Route::get('/peminjaman/{id}/edit', [PeminjamanPengembalianController::class, 'edit'])->name('peminjaman.edit');
Route::put('/peminjaman/{id}', [PeminjamanPengembalianController::class, 'update'])->name('peminjaman.update');
Route::delete('/peminjaman/{id}', [PeminjamanPengembalianController::class, 'destroy'])->name('peminjaman.destroy');

// Pengembalian routes
Route::get('/pengembalian', [PeminjamanPengembalianController::class, 'indexPengembalian'])->name('halaman.pengembalian');
Route::get('/pengembalian/{id}/edit', [PeminjamanPengembalianController::class, 'edit'])->name('pengembalian.edit');
Route::put('/pengembalian/{id}', [PeminjamanPengembalianController::class, 'update'])->name('pengembalian.update');
Route::delete('/pengembalian/{id}', [PeminjamanPengembalianController::class, 'destroy'])->name('pengembalian.destroy');
// Rute untuk menampilkan form pengembalian baru
Route::get('/pengembalian/create', [PeminjamanPengembalianController::class, 'createPengembalian'])->name('pengembalian.create');

// Rute untuk menyimpan data pengembalian baru
Route::post('/pengembalian', [PeminjamanPengembalianController::class, 'storePengembalian'])->name('pengembalian.store');


