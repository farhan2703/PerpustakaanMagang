<!DOCTYPE html>
<html lang="en">

<head> 
    @include('template.header')
</head>

<body>

  <header id="header" class="header fixed-top d-flex align-items-center">
    @include('template.headerbody')
  </header>

  <aside id="sidebar" class="sidebar">
    @include('template.sidebar')
  </aside>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Data Peminjaman</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Peminjaman</li>
        </ol>
      </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Peminjaman</h5>
                    <div class="container">
                        <div class="text-end">
                            <a href="{{ route('peminjaman.create') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                                <i class="bi bi-plus"></i>
                            </a>
                        </div>
                        
                        <h5>Daftar Peminjaman</h5>
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
                                    <th scope="col">Tanggal Peminjaman</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="peminjamanTable">
                                @foreach($peminjamans as $peminjaman)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $peminjaman->buku->judul }}</td>
                                    <td>{{ $peminjaman->member->nama }}</td>
                                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                                    <td> 
                                        <span class="badge bg-warning">{{ $peminjaman->status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="btn btn-warning shadow btn-xs sharp">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('peminjaman.destroy', $peminjaman->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger shadow btn-xs sharp">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $peminjamans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
