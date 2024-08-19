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
                          <a type="button" class="btn btn-danger me-2" title="Export Pdf" href="{{ url('generate-pdf') }}">
                              <i class="bx bxs-file-pdf"></i> 
                          </a>
                          <a  class="btn btn-info me-2" href="{{ url('buku/export/excel') }}">
                            <i class="bi bi-download"></i>
                        </a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

   @include('templatemember.scripts')
<input type="hidden" id="buku-table-url" value="{{ route('tableBuku') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
<script src="{{ asset('main.js') }}"></script>
</body>
</html>
