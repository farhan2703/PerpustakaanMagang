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
            <h1>Tabel Kategori Buku</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Kategori Buku</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Kategori Buku</h5>
                        <!-- Bordered Table -->
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Tanggal Dibuat</th>
                                    <th scope="col">Tanggal Diperbarui</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="kategoriTable">
                                @foreach($kategoriBuku as $kategori)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>{{ $kategori->deskripsi_kategori }}</td>
                                    <td>{{ $kategori->tanggal_dibuat }}</td>
                                    <td>{{ $kategori->tanggal_diperbarui }}</td>
                                    <td>
                                        <a href="{{ route('halaman.kategoribuku.detail', $kategori->id_kategori) }}" class="btn light btn-secondary shadow btn-xs sharp mr-1"><i class="bi bi-info-circle"></i></a>
                                        <a href="#" class="btn light btn-warning shadow btn-xs sharp mr-1"><i class="bi bi-pencil-square"></i></a>
                                        <a href="#" class="btn light btn-danger shadow btn-xs sharp mr-1"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination links -->
                        <div class="d-flex justify-content-end">
                            {{ $kategoriBuku->links() }}
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
