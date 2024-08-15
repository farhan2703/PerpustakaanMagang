<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dropdown Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <!-- Profile Dropdown -->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                    @php
                        use Illuminate\Support\Facades\Auth;
                        $user = Auth::user();
                        $roles = $user->getRoleNames()->implode(', '); // Mengambil nama role dan menggabungkannya dengan koma
                    @endphp
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        {{ $user->nama }}
                        @if($roles)
                            <small class="text-muted d-block">{{ $roles }}</small>
                        @endif
                    </span>
                </a<!-- End Profile Image Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>Ubah Profile</span>
                        </a>
                    </li>
                    <li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
    
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="ri-user-shared-line"></i>
                                <span>Switch Role</span>
                            </a>
                        </li>
                        <hr class="dropdown-divider">
                    </li>
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
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(function (dropdown) {
                new bootstrap.Dropdown(dropdown);
            });
        });
    </script>

</body>
</html>
