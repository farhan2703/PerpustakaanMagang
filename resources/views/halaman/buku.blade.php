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
                    <div class="text-end mb-3">
                      <div class="d-flex justify-content-end">
                          <a href="{{ route('addbuku') }}" class="btn btn-success me-2" title="Add">
                              <i class="bi bi-plus"></i>
                          </a>
                          <button type="button" class="btn btn-warning" title="Import" data-bs-toggle="modal" data-bs-target="#importModal">
                              <i class="bi bi-upload"></i> 
                          </button>
                      </div>
                  </div>
                  
                  <!-- Modal untuk impor data buku -->
                  <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="importModalLabel">Import Data Buku</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <!-- Form untuk mengunggah file Excel -->
                                  <form action="{{ route('import-buku') }}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      <div class="form-group">
                                          <label for="file">Pilih File Excel</label>
                                          <input type="file" class="form-control-file" id="file" name="file" required>
                                      </div>
                                      <button type="submit" class="btn btn-primary">Import</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                   
                  </div>
                  
                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                        @endif
                  
                    <!-- Bordered Table -->
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Tahun Terbit</th>
                                <th scope="col">Status</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Kategori</th>
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
                                <td>
                                  @if($b->stok > 0)
                                      <span class="badge bg-success">{{ $b->status_ketersediaan }}</span>
                                  @else
                                      <span class="badge bg-danger">Tidak tersedia</span>
                                  @endif
                              </td>
                              
                                <td>{{ $b->stok }}</td>
                                <td>{{ $b->kategori }}</td>
                                <th>
                                    <a href="{{ route('halaman.buku.detail', $b->id_buku) }}" class="btn light btn-secondary shadow btn-xs sharp mr-1"><i class="bi bi-info-circle"></i></a>
                                    <form id="editForm_{{ $b->id_buku }}" action="{{ route('halaman.buku.edit', $b->id_buku) }}" method="GET" style="display: inline;">
                                      @csrf
                                      <button type="submit" class="btn btn-warning shadow btn-xs sharp">
                                          <i class="bi bi-pencil-square"></i>
                                      </button>
                                  </form>
                                  <form action="{{ route('buku.forcedelete', $b->id_buku) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger shadow btn-xs sharp">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form></th>
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
