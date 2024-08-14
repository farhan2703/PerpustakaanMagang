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
                    <div class="container">
                        <div class="text-end">
                            <a href="{{ route('pengembalian.create') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                                <i class="bi bi-plus"></i>
                            </a>
                        </div>
                        
                        <h5>Daftar Peminjaman</h5>
                        <div class="card-body">
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
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status</th>
                                            <th>Option</th>
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
        <input type="hidden" id="pengembalian-table-url" value="{{ route('tablePengembalian') }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
        <script src="{{ asset('main.js') }}"></script>
        </body>
        </html>