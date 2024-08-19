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
      <h1>Data Pengembalian</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Pengembalian</li>
        </ol>
      </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Pengembalian</h5>
                        {{-- <div class="text-end">
                            <a href="{{ route('pengembalian.create') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                                <i class="bi bi-plus"></i>
                            </a>
<<<<<<< HEAD
                        </div>

                        <h5>Daftar Pengembalian</h5>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Nama Member</th>
                                    <th scope="col">Tanggal Pengembalian</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody id="pengembalianTable">
                                @foreach($pengembalians as $pengembalian)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $pengembalian->buku->judul }}</td>
                                    <td>{{ $pengembalian->member->nama }}</td>
                                    <td>{{ $pengembalian->tanggal_pengembalian }}</td>
                                    <td><span class="badge bg-success">{{ $pengembalian->status }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $pengembalians->links() }}
=======
                        </div> --}}
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                </div>
                            @endif
        
                            <div class="table-responsive">
                                <table id="pengembalianTable" class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Buku</th>
                                            <th>Nama Member</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
>>>>>>> 32d440794a4748956fe41f43ee2ab3275116ff93
                        </div>
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
    </section>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
=======
        </div>
        @include('templatemember.scripts')
        <input type="hidden" id="pengembalian-table-url" value="{{ route('tablePengembalian') }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
        <script src="{{ asset('main.js') }}"></script>
        </body>
        </html>
>>>>>>> 32d440794a4748956fe41f43ee2ab3275116ff93
