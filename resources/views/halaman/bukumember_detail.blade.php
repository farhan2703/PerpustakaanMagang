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
            <h1>Detail Buku</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('halaman.bukumember') }}">Buku</a></li>
                    <li class="breadcrumb-item active">Detail Buku</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>Detail Buku: {{ $buku->judul }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">ID Buku:</div>
                                <div class="col-sm-8">{{ $buku->id_buku }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Judul Buku:</div>
                                <div class="col-sm-8">{{ $buku->judul }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Penulis:</div>
                                <div class="col-sm-8">{{ $buku->penulis }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Penerbit:</div>
                                <div class="col-sm-8">{{ $buku->penerbit }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Tahun Terbit:</div>
                                <div class="col-sm-8">{{ $buku->tahun_terbit }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Status Ketersediaan:</div>
                                <div class="col-sm-8">
                                    @if($buku->stok > 0)
                                      <span class="badge bg-success">{{ $buku->status_ketersediaan }}</span>
                                  @else
                                      <span class="badge bg-danger">Tidak tersedia</span>
                                  @endif
                                   
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Stok:</div>
                                <div class="col-sm-8">{{ $buku->stok }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Kategori:</div>
                                <div class="col-sm-8">{{ $buku->kategori }}</div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('halaman.bukumember') }}" class="btn btn-secondary">Kembali ke Daftar Buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
    @include('templatemember.scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
    <script src="{{ asset('main.js') }}"></script>
    </body>
</html>
