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
        </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Kategori Buku</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('halaman.kategoribuku') }}">Kategori Buku</a></li>
                    <li class="breadcrumb-item active">Detail Kategori Buku</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>Detail Kategori Buku: {{ $kategoriBuku->nama_kategori }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">ID Kategori:</div>
                                <div class="col-sm-8">{{ $kategoriBuku->id_kategori }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Nama Kategori:</div>
                                <div class="col-sm-8">{{ $kategoriBuku->nama_kategori }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Deskripsi:</div>
                                <div class="col-sm-8">{{ $kategoriBuku->deskripsi_kategori }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Tanggal Dibuat:</div>
                                <div class="col-sm-8">{{ $kategoriBuku->tanggal_dibuat }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Tanggal Diperbarui:</div>
                                <div class="col-sm-8">{{ $kategoriBuku->tanggal_diperbarui }}</div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('halaman.kategoribuku') }}" class="btn btn-secondary">Kembali ke Daftar Kategori Buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
