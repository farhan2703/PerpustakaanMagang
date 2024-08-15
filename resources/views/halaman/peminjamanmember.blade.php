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
                            <a href="{{ route('peminjamanmember.create') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                                <i class="bi bi-journal-plus"></i>
                            </a>
                        </div>
                        <h5>Daftar Peminjaman</h5>
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                </div>
                            @endif
        
                            <!-- Hidden input to store user ID -->
                            <input type="hidden" id="user-id" value="{{ Auth::user()->nama }}">

                            <table id="peminjamanmemberTable" class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Nama Member</th>
                                        <th>Tanggal Peminjaman</th>
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
    </section>
  </main>

  @include('templatemember.scripts')
  <input type="hidden" id="peminjamanmember-table-url" value="{{ route('tablePeminjamanMember') }}">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
        <script src="{{ asset('main.js') }}"></script>
        </body>
        </html>