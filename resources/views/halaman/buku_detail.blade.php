<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.header')
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        @include('template.headerbody')
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        @include('template.sidebar')
    </aside><!-- End Sidebar -->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Detail Buku</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('halaman.buku') }}">Buku</a></li>
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
                                    <span class="badge bg-success">{{ $buku->status_ketersediaan }}</span>
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
                            <a href="{{ route('halaman.buku') }}" class="btn btn-secondary">Kembali ke Daftar Buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
