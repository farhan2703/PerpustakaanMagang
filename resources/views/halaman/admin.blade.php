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
<<<<<<< HEAD

=======
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <strong>Success!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                                </div>
                            @endif
>>>>>>> 32d440794a4748956fe41f43ee2ab3275116ff93

                            <div class="table-responsive">
                                <table id="adminTable" class="table table-responsive-md">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No Telepon</th>
                                            <th>Email</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
<<<<<<< HEAD
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
=======
                        </div>
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
  <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
=======
    </div>
>>>>>>> 32d440794a4748956fe41f43ee2ab3275116ff93

   @include('templatemember.scripts')
    <input type="hidden" id="admin-table-url" value="{{ route('tableAdmin') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
    <script src="{{ asset('main.js') }}"></script>
</body>
</html>
