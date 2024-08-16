<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuMemberController;
use App\Http\Controllers\BukuuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\MemberController;

use App\Http\Controllers\UserProfilController;
use App\Http\Controllers\MemberPeminjamanPengembalian;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanPengembalianController;
use App\Http\Controllers\RoleController;
use App\Models\Admin;
use App\Models\Buku;
use Illuminate\Support\Facades\Route;


// Route untuk menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk mengirimkan form login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route untuk menampilkan form register
Route::get('/register', function () {
    return view('sign.register');
})->name('register');

// Route untuk mengirimkan form register
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');


// Route  logout admin

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route untuk dashboard member
Route::get('/headerbody', function () {
    return view('member.dashboard');
})->name('halaman.dashboard')->middleware('auth');

// Halaman utama
Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::group(['middleware' => ['permission:master_buku']], function () {
// Buku routes
    Route::get('/tableBuku', [BukuuController::class, 'tableBuku'])->name('tableBuku');
    Route::post('/imporexceltbuku', [BukuuController::class, 'imporexceltbuku'])->name('imporexceltbuku');
    Route::get('/export.template', [BukuuController::class, 'export_template'])->name('export.template');
    Route::get('buku/export/excel',[BukuuController::class, 'export_excel']);
    Route::get('generate-pdf',[BukuuController::class, 'export_pdf']);
    Route::get('/buku', [BukuuController::class, 'buku'])->name('halaman.buku');
    Route::get('/addbuku', [BukuuController::class, 'create'])->name('addbuku');
    Route::post('/buku', [BukuuController::class, 'store'])->name('halaman.buku.store');
    Route::get('/buku/{id}', [BukuuController::class, 'detail'])->name('halaman.buku.detail');
    Route::get('/buku/edit/{id}', [BukuuController::class, 'edit'])->name('halaman.buku.edit');
    Route::put('/buku/update/{id}', [BukuuController::class, 'update'])->name('halaman.buku.update');
    Route::delete('/buku/{id}', [BukuuController::class, 'forcedelete'])->name('buku.forcedelete');
});

// Member dashboard
Route::group(['middleware' => ['permission:dashboard']], function () {
    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('halaman.dashboard');
    Route::get('/jumlah-buku-tersedia', [MemberController::class, 'jumlahbukutersedia'])->name('jumlah-buku-tersedia');
    Route::get('/jumlah-buku-dipinjam', [MemberController::class, 'jumlahBukuDipinjam'])->name('jumlah-buku-dipinjam');
    Route::get('/total-buku', [MemberController::class, 'totalBuku'])->name('total-buku');
    Route::get('/chart-data', [MemberController::class, 'getChartData'])->name('chart-data');
});

Route::group(['middleware' => ['permission:member']], function () {
//Route member
    Route::get('/member', [MemberController::class, 'member'])->name('halaman.member');
    Route::get('/table', [MemberController::class, 'table'])->name('table');
    Route::get('/add_member', [MemberController::class, 'create'])->name('add_member');
    Route::post('/member/store', [MemberController::class, 'store'])->name('member.store');
    Route::get('/member/{id_member}/edit_member', [MemberController::class, 'edit'])->name('member.edit');
    Route::put('/member/{id_member}/edit_member', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/member/{id_member}/destroy', [MemberController::class, 'forcedelete'])->name('member_forcedelete');
    Route::get('/edit-profile', [MemberController::class, 'editProfile'])->name('edit.editprofile');
});

Route::group(['middleware' => ['permission:admin']], function () {
 //Route admin
    Route::get('/admin', [AdminController::class, 'admin'])->name('halaman.admin');
    Route::get('/tableAdmin', [AdminController::class, 'tableAdmin'])->name('tableAdmin');
    Route::get('/add_admin', [AdminController::class, 'create'])->name('add_admin');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}/edit_admin', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{id}/edit_admin', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}/destroy', [AdminController::class, 'forcedelete'])->name('admin_forcedelete');
});

Route::group(['middleware' => ['permission:peminjaman']], function () {
// Peminjaman routes
    Route::get('/tablePeminjaman', [PeminjamanPengembalianController::class, 'tablePeminjaman'])->name('tablePeminjaman');
    Route::get('/peminjaman', [PeminjamanPengembalianController::class, 'indexPeminjaman'])->name('halaman.peminjaman');
    Route::get('/peminjaman/create', [PeminjamanPengembalianController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanPengembalianController::class, 'store'])->name('peminjaman.store');
    Route::get('/peminjaman/{id}/edit', [PeminjamanPengembalianController::class, 'edit'])->name('peminjaman.edit');
    Route::put('/peminjaman/{id}', [PeminjamanPengembalianController::class, 'update'])->name('peminjaman.update');
    Route::delete('/peminjaman/{id}', [PeminjamanPengembalianController::class, 'destroy'])->name('peminjaman.destroy');
});

Route::group(['middleware' => ['permission:pengembalian']], function () {
// Pengembalian routes
    Route::get('/tablePengembalian', [PeminjamanPengembalianController::class, 'tablePengembalian'])->name('tablePengembalian');
    Route::get('/pengembalian', [PeminjamanPengembalianController::class, 'indexPengembalian'])->name('halaman.pengembalian');
    Route::get('/pengembalian/{id}/edit', [PeminjamanPengembalianController::class, 'edit'])->name('pengembalian.edit');
    Route::put('/pengembalian/{id}', [PeminjamanPengembalianController::class, 'update'])->name('pengembalian.update');
    Route::delete('/pengembalian/{id}', [PeminjamanPengembalianController::class, 'destroy'])->name('pengembalian.destroy');
    Route::get('/pengembalian/create', [PeminjamanPengembalianController::class, 'createPengembalian'])->name('pengembalian.create');
    Route::post('/pengembalian', [PeminjamanPengembalianController::class, 'storePengembalian'])->name('pengembalian.store');
});

// Rute untuk menampilkan form pengembalian baru
    Route::get('/pengembalian/create', [PeminjamanPengembalianController::class, 'createPengembalian'])->name('pengembalian.create');

// Rute untuk menyimpan data pengembalian baru
    Route::post('/pengembalian', [PeminjamanPengembalianController::class, 'storePengembalian'])->name('pengembalian.store');

Route::group(['middleware' => ['permission:kategori_buku']], function () {
// Kategori Buku routes
    Route::get('/tableKategori', [KategoriBukuController::class, 'tableKategori'])->name('tableKategori');
    Route::get('/kategoribuku', [KategoriBukuController::class, 'kategoribuku'])->name('halaman.kategoribuku');
    Route::get('/addkategoribuku', [KategoriBukuController::class, 'create'])->name('addkategoribuku');
    Route::post('/kategoribuku', [KategoriBukuController::class, 'store'])->name('halaman.kategoribuku.store');
    Route::get('/kategoribuku/{id}', [KategoriBukuController::class, 'detail'])->name('halaman.kategoribuku.detail');
    Route::get('/kategoribuku/{id_kategori}/edit_kategoribuku', [KategoriBukuController::class, 'edit'])->name('halaman.kategoribuku.edit');
    Route::put('/kategoribuku/{id_kategori}/edit_kategoribuku', [KategoriBukuController::class, 'update'])->name('kategoribuku.update');
    Route::delete('/kategoribuku/{id}/destroy', [KategoriBukuController::class, 'forcedelete'])->name('kategori.forcedelete');
});


// Route Member
Route::group(['middleware' => ['permission:buku']], function () {
    Route::get('/bukumember/{id}', [BukuMemberController::class, 'detailmember'])->name('halaman.buku.detail');
    Route::get('/bukumember', [BukuMemberController::class, 'bukumember'])->name('halaman.bukumember');
    Route::get('/tableBukuMember', [BukuMemberController::class, 'tableBukuMember'])->name('tableBukuMember');
    });

Route::group(['middleware' => ['permission:peminjamanmember']], function () {
    // Peminjaman routes
    Route::get('/peminjaman-member', [MemberPeminjamanPengembalian::class, 'tablePeminjamanMember'])->middleware('auth');
    Route::get('/tablePeminjamanMember', [MemberPeminjamanPengembalian::class, 'tablePeminjamanMember'])->name('tablePeminjamanMember');
    Route::get('/peminjamanmember', [MemberPeminjamanPengembalian::class, 'indexPeminjamanmember'])->name('halaman.peminjamanmember');
    Route::get('/peminjamanmember/create', [MemberPeminjamanPengembalian::class, 'create'])->name('peminjamanmember.create');
    Route::post('/peminjamanmember', [MemberPeminjamanPengembalian::class, 'store'])->name('peminjamanmember.store');
    Route::get('/peminjaman/{id}/detail', [MemberPeminjamanPengembalian::class, 'showDetail'])->name('peminjamanmember.detail');
    Route::get('/peminjamanmember/{id}/edit_peminjamanmember', [MemberPeminjamanPengembalian::class, 'edit'])->name('peminjamanmember.edit');
    Route::put('/peminjamanmember/{id}/edit_peminjamanmember', [MemberPeminjamanPengembalian::class, 'update'])->name('peminjamanmember.update');
 });


// Peminjaman routes
Route::group(['middleware' => ['permission:pengembalianmember']], function () {
     Route::get('/pengembalian-member', [MemberPeminjamanPengembalian::class, 'tablePengembalianMember'])->middleware('auth');
     Route::get('/tablePengembalianMember', [MemberPeminjamanPengembalian::class, 'tablePengembalianMember'])->name('tablePengembalianMember');
     Route::get('/pengembalianmember', [MemberPeminjamanPengembalian::class, 'indexPengembalianmember'])->name('halaman.pengembalianmember');
     Route::get('/pengembalian/{id}/detail', [MemberPeminjamanPengembalian::class, 'showDetailpengembalian'])->name('pengembalianmember.detail');
});

// Role routes
Route::group(['middleware' => ['permission:role']], function () {
    Route::get('/role', [RoleController::class, 'role'])->name('halaman.role');
    Route::get('/tableRole', [RoleController::class, 'tableRole'])->name('tableRole');
    Route::get('/role/{id}/edit_role', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/{id}/edit_role', [RoleController::class, 'update'])->name('role.update');
 });

 // Admin routes
Route::group(['middleware' => ['permission:admin']], function (){
    Route::get('/admin', [AdminController::class, 'admin'])->name('halaman.admin');
    Route::get('/add_admin', [AdminController::class, 'create'])->name('add_admin');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'forcedelete'])->name('admin_forcedelete');
});

//Route profile
    Route::get('/userprofil/edit/{id}', [UserProfilController::class, 'edit'])->name('userprofil.edit');
    Route::put('/userprofil/{id}', [UserProfilController::class, 'update'])->name('userprofil.update');



