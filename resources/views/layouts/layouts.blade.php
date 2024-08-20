<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  
  <title>Pepustaka</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center">
            <img src="img/apple-touch-icon.png" alt="">
            <span class="d-none d-lg-block">Perpustakaan</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->
    @php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;
    
    $user = Auth::user();
    $rolesArray = $user->getRoleNames()->toArray();
    $currentRole = session('currentRole', $rolesArray[0]); // Default ke role pertama jika session tidak ada
    
    // Menentukan role yang ditampilkan
    $displayRole = implode(', ', $rolesArray);
    
    // Menentukan apakah harus menampilkan tombol switch
    $showSwitch = count($rolesArray) > 1; // Menampilkan switch jika memiliki lebih dari satu role
    @endphp
    
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <!-- Profile Dropdown -->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Profile" class="profile-img">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        {{ $user->nama }}
                        <small class="text-muted d-block">
                            @php
                            $rolesArray = array_map('strtolower', $rolesArray); // Convert to lowercase
                            $currentRole = strtolower(session('currentRole', $rolesArray[0]));
                            @endphp
                            @if ($currentRole === 'admin')
                                Admin
                            @elseif ($currentRole === 'member')
                                Member
                            @elseif ($currentRole === 'admin,member')
                                Admin, Member
                            @endif
                        </small>
                    </span>
                </a><!-- End Profile Image Icon -->
    
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person"></i>
                            <span>Ubah Profile</span>
                        </a>
                    </li>
                    
                    <li><hr class="dropdown-divider"></li>
                    <!-- Role Switching -->
                    @if($showSwitch)
                        <li>
                            @if(in_array('admin', $rolesArray) && in_array('member', $rolesArray))
                                @if($currentRole === 'admin')
                                    <a class="dropdown-item" href="{{ route('switch.role', 'member') }}">
                                        <i class="ri-user-line"></i> Switch to Member
                                    </a>
                                @elseif($currentRole === 'member')
                                    <a class="dropdown-item" href="{{ route('switch.role', 'admin,member') }}">
                                        <i class="ri-user-line"></i> Switch to Admin, Member
                                    </a>
                                @elseif($currentRole === 'admin,member')
                                    <a class="dropdown-item" href="{{ route('switch.role', 'admin') }}">
                                        <i class="ri-user-line"></i> Switch to Admin
                                    </a>
                                @endif
                            @elseif(in_array('admin', $rolesArray))
                                <a class="dropdown-item" href="{{ route('switch.role', 'admin') }}">
                                    <i class="ri-user-line"></i> Switch to Admin
                                </a>
                            @elseif(in_array('member', $rolesArray))
                                <a class="dropdown-item" href="{{ route('switch.role', 'member') }}">
                                    <i class="ri-user-line"></i> Switch to Member
                                </a>
                            @endif
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @endif
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
    
    <!-- Bootstrap JS, Popper.js, and jQuery -->
    
    
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    @php
    $currentRole = session('currentRole', 'admin,member'); // Default ke 'admin,member' jika session tidak ada
@endphp

<ul class="sidebar-nav" id="sidebar-nav">
    @if ($currentRole === 'admin' || $currentRole === 'admin,member' || $currentRole === 'member')
        @can('dashboard')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @endcan
    @endif

    <li class="nav-heading">Buku</li>

    @if ($currentRole === 'admin' || $currentRole === 'admin,member')
        @can('master_buku')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.buku') }}">
                <i class="bi bi-book"></i>
                <span>Master Buku</span>
            </a>
        </li>
        @endcan
    @endif
    
    @if ($currentRole === 'member' || $currentRole === 'admin,member')
        @can('buku')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.bukumember') }}">
                <i class="ri-book-2-line"></i>
                <span>Buku</span>
            </a>
        </li>
        @endcan
    @endif

    @if ($currentRole === 'admin' || $currentRole === 'admin,member')
        @can('kategori_buku')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.kategoribuku') }}">
                <i class="ri ri-bar-chart-horizontal-line"></i>
                <span>Kategori Buku</span>
            </a>
        </li>
        @endcan
    @endif

    @if ($currentRole === 'admin' || $currentRole === 'admin,member')
        @can('admin')
        <li class="nav-heading">Akun</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.admin') }}">
                <i class="bi bi-person"></i>
                <span>Admin</span>
            </a>
        </li>
        @endcan

        @can('member')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.member') }}">
                <i class="bi bi-gem"></i>
                <span>Member</span>
            </a>
        </li>
        @endcan
    @endif

    <li class="nav-heading">Transaksi</li>

    @if ($currentRole === 'admin' || $currentRole === 'admin,member')
        @can('peminjaman')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.peminjaman') }}">
                <i class="ri-stack-fill"></i>
                <span>Data Peminjaman</span>
            </a>
        </li>
        @endcan
    @endif

    @if ($currentRole === 'member' || $currentRole === 'admin,member')
        @can('peminjamanmember')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.peminjamanmember') }}">
                <i class="bx bx-archive-out"></i>
                <span>Peminjaman</span>
            </a>
        </li>
        @endcan
    @endif

    @if ($currentRole === 'admin' || $currentRole === 'admin,member')
        @can('pengembalian')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.pengembalian') }}">
                <i class="ri-history-line"></i>
                <span>Histori Pengembalian</span>
            </a>
        </li>
        @endcan
    @endif

    @if ($currentRole === 'member' || $currentRole === 'admin,member')
        @can('pengembalianmember')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.pengembalianmember') }}">
                <i class="ri ri-arrow-go-back-fill"></i>
                <span>Pengembalian</span>
            </a>
        </li>
        @endcan
    @endif

    @if ($currentRole === 'admin,member')
        @can('role')
        <li class="nav-heading">Management</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.role') }}">
                <i class="bi bi-person-bounding-box"></i>
                <span>Role</span>
            </a>
        </li>
        @endcan

        @can('datauser')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.datauser') }}">
                <i class="bi bi-key"></i>
                <span>Permission</span>
            </a>
        </li>
        @endcan
    @endif
    </ul>
  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
    @yield('main')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Perpustaka</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://bootstrapmade.com/"></a>
    </div>
  </footer><!-- End Footer -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Ini adalah bagian yang penting untuk memastikan dropdown berfungsi -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi dropdown Bootstrap
            var dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(function (dropdown) {
                new bootstrap.Dropdown(dropdown);
            });
        });
    </script>
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js')}}"></script>

</body>

</html>