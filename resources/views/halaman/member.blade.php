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
      <h1>Tabel Buku</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Buku</h5>
                    <!-- Bordered Table -->
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Penerbit</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="bukuTable">
                            @foreach($Buku as $b)
                            <tr>
                                <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
                                <td>{{ $b->judul }}</td>
                                <td>{{ $b->penulis }}</td>
                                <td>{{ $b->penerbit }}</td>
                                <td>{{ $b->tahun_terbit }}</td>
                                <td><span class="badge bg-success">{{ $b->status_ketersediaan }}</td>
                                <td>{{ $b->stok }}</td>
                                <td>{{ $b->kategori }}</td>
                                <th>
                                    <a href="{{ route('halaman.buku.detail', $b->id_buku) }}" class="btn light btn-secondary shadow btn-xs sharp mr-1"><i class="bi bi-info-circle"></i></a>
                                    <a href="#" class="btn light btn-warning shadow btn-xs sharp mr-1"><i class="bi bi-pencil-square"></i></a>
                                    <a href="#" class="btn light btn-danger shadow btn-xs sharp mr-1"><i class="bi bi-trash"></i></a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination links -->
                    <div class="d-flex justify-content-end">
                        {{ $Buku->links() }}
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

  <script src="assets/js/main.js"></script>

</body>

</html>
