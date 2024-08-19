<!DOCTYPE html>
<html lang="en">

<head>
    @include('templatemember.header')
</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">
    @include('templatemember.headerbody')
</header>

<aside id="sidebar" class="sidebar">
    @include('templatemember.sidebar')
</aside>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Buku</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('halaman.buku') }}">Buku</a></li>
                <li class="breadcrumb-item active">Edit Buku</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Buku</h5>
                        </div>
                        <div class="card-body">

                            <!-- General Form Elements -->
                            <form action="{{ route('halaman.buku.update', $buku->id_buku) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group row mb-3">
                                    <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $buku->penerbit }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="stok" name="stok" value="{{ $buku->stok }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                                    <div class="col-sm-9">
                                        <select id="kategori" name="kategori" class="form-select" required>
                                            <option value="" disabled>Pilih Kategori</option>
                                            @foreach($kategoris as $kategori)
                                                <option value="{{ $kategori->nama_kategori }}" {{ $buku->kategori == $kategori->nama_kategori ? 'selected' : '' }}>
                                                    {{ $kategori->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('halaman.buku') }}" class="btn btn-secondary ms-2">Cancel</a>
                                    </div>
                                </div>

                            </form>
                            <!-- End General Form Elements -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>


</body>

</html>
