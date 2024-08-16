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
        <h1>Update Kategori Buku</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('halaman.kategoribuku') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Kategori Buku</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Kategori Buku</h5>
                        </div>
                        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('kategoribuku.update', $kategori->id_kategori) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row mb-3">
                    <label for="nama_kategori" class="col-sm-3 col-form-label">Nama Kategori</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="deskripsi_kategori" class="col-sm-3 col-form-label">Deskripsi Kategori</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="deskripsi_kategori" name="deskripsi_kategori" required>{{ $kategori->deskripsi_kategori }}</textarea>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="tanggal_dibuat" class="col-sm-3 col-form-label">Tanggal Dibuat</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" value="{{ $kategori->tanggal_dibuat }}" required>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="tanggal_diperbarui" class="col-sm-3 col-form-label">Tanggal Diperbarui</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_diperbarui" name="tanggal_diperbarui" value="{{ $kategori->tanggal_diperbarui }}">
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('halaman.kategoribuku') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </div>
                </div>

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

<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>
