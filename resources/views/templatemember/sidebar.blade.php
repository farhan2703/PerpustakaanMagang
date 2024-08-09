<ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-heading">Buku</li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('halaman.buku') }}">
            <i class="bi bi-book"></i>
            <span>Buku</span>
        </a>
    </li>
    
    <li class="nav-heading">Transaksi</li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('halaman.peminjaman') }}">
            <i class="bx bx-archive-out"></i>
            <span>Peminjaman</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('halaman.pengembalian') }}">
            <i class="ri ri-arrow-go-back-fill"></i>
            <span>Pengembalian</span>
        </a>
    </li>
</ul>
