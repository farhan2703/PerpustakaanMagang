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
                    <div class="">
                        <a type="button" class="btn btn-warning me-2" title="Import" data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="bi bi-upload"></i> 
                        </a>
                    </div>
                    <div class="text-end mb-3">
                      <div class="d-flex justify-content-end">
                          <a href="{{ route('addbuku') }}" class="btn btn-success me-2" title="Add">
                              <i class="bi bi-plus"></i>
                          </a>
<<<<<<< HEAD
                          <button type="button" class="btn btn-warning" title="Import" data-bs-toggle="modal" data-bs-target="#importModal">
                              <i class="bi bi-upload"></i>
                          </button>
                      </div>
                  </div>

=======
                          <a type="button" class="btn btn-danger me-2" title="Export Pdf" href="{{ url('generate-pdf') }}">
                              <i class="bx bxs-file-pdf"></i> 
                          </a>
                          <a  class="btn btn-info me-2" href="{{ url('buku/export/excel') }}">
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                  </div>
>>>>>>> 32d440794a4748956fe41f43ee2ab3275116ff93
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
                                  <form action="{{ route('imporexceltbuku') }}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      <div class="form-group">
                                          <label for="file">Pilih File Excel</label>
                                          <input type="file" class="form-control-file" id="file" name="file" required>
                                      </div>
                              </div>
                              <div class="modal-footer d-flex justify-content-between">
                                <a href="{{ route('export.template') }}" class="small-text">Download template</a>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                            </form>
                          </div>
                      </div>
                  </div>

                  </div>
<<<<<<< HEAD

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
=======
                  
                  <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="bukuTable" class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tahun Terbit</th>
                                    <th>Status</th>
                                    <th>Stok</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
>>>>>>> 32d440794a4748956fe41f43ee2ab3275116ff93
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
    </section>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <script src="{{ asset('assets/js/main.js') }}"></script>
=======
    </div>
</div>
</div>
>>>>>>> 32d440794a4748956fe41f43ee2ab3275116ff93

   @include('templatemember.scripts')
<input type="hidden" id="buku-table-url" value="{{ route('tableBuku') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
<script src="{{ asset('main.js') }}"></script>
</body>
</html>
