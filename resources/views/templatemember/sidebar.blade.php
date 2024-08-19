@php
    $currentRole = session('currentRole','admin,member'); // Default ke 'admin' jika session tidak ada
@endphp

<ul class="sidebar-nav" id="sidebar-nav">
    @if ($currentRole === 'admin' || $currentRole === 'admin,member'|| $currentRole === 'member' )
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
                <span> Buku </span>
            </a>
        </li>
        @endcan
    @endif

    @if ($currentRole === 'admin' || $currentRole === 'admin,member')
        @can('kategori_buku')
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('halaman.kategoribuku') }}">
                <i class="ri ri-bar-chart-horizontal-line"></i>
                <span>Kategori Buku </span>
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
