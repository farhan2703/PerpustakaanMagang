<!DOCTYPE html>
<html lang="en">
<head> 
    @include('templatemember.header')
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    @include('templatemember.headerbody')
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    @include('templatemember.sidebar')
  </aside><!-- End Sidebar -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Detail Peminjaman Buku</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('halaman.peminjamanmember') }}">Peminjaman Buku</a></li>
          <li class="breadcrumb-item active">Detail Peminjaman Buku</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h5>Detail Peminjaman Buku</h5>
            </div>
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">ID Peminjaman:</div>
                <div class="col-sm-8">{{ $peminjaman->id }}</div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">Judul Buku:</div>
                <div class="col-sm-8">{{ $peminjaman->buku->judul }}</div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">Nama Member:</div>
                <div class="col-sm-8">{{ $peminjaman->member->nama }}</div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">Tanggal Peminjaman:</div>
                <div class="col-sm-8">{{ $peminjaman->tanggal_peminjaman }}</div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">Status:</div>
                <div class="col-sm-8">{{ $peminjaman->status }}</div>
              </div>
            </div>
            <div class="card-footer text-end">
              <a href="{{ route('halaman.peminjamanmember') }}" class="btn btn-secondary">Kembali ke Daftar Peminjaman</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main --><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
