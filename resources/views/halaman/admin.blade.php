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
      <h1>Tabel Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Admin</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabel Admin</h5>
                    <div class="container">
                        <div class="text-end">
                            <a href="{{ route('add_admin') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                                <i class="bi bi-plus"></i>
                            </a>
                        </div>
                        

                        <h5>Daftar Admin</h5>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Admin</th>
                                <th scope="col">Username</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No Telepon</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="adminTable">
                            @foreach($admins as $admin)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $admin->nama_admin }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->alamat }}</td>
                                <td>{{ $admin->no_telepon }}</td>
                                <td>{{ $admin->tanggal_lahir }}</td>
                                <td>
                                    <form id="editForm_{{ $admin->id_admin }}" action="{{ route('admin.edit', $admin->id_admin) }}" method="GET" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning shadow btn-xs sharp">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin_forcedelete', $admin->id_admin) }}" method="POST" style="display: inline;">
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
                    <!-- Pagination links -->
                    <div class="d-flex justify-content-end">
                        {{ $admins->links() }}
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
