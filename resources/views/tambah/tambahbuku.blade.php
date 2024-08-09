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
        <h1>Tambah Buku Baru</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('halaman.buku') }}">Home</a></li>
                <li class="breadcrumb-item active">Tambah Buku Baru</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
    
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tambah Buku Baru</h5>
                        </div>
                        <div class="card-body">
    
        
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        
            <form action="{{ route('halaman.buku.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" id="judul" required>
                </div>
        
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" id="penulis" required>
                </div>
        
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" class="form-control" id="penerbit" required>
                </div>
        
                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="date" name="tahun_terbit" class="form-control" id="tahun_terbit" required>
                </div>
        
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" id="stok" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <div>
                        <div class="mb-3">
                            <select name="kategori" id="kategori" class="form-select" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        
                <button type="submit" class="btn btn-primary">Tambah Buku</button>
            </form>
        </div></section>
    
</main>

<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>

</html>
