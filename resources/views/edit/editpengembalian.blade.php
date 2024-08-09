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
        <h1>Edit Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('halaman.admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Edit Admin</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="container">
            <h2>Edit Data Peminjaman</h2>
        
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        
            <form action="{{ route('peminjaman.update', $peminjamanPengembalian->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group row mb-3">
                    <label for="buku_id" class="col-sm-3 col-form-label">Buku</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="buku_id" name="buku_id" required>
                            <option value="">Pilih Buku</option>
                            @foreach($bukus as $buku)
                                <option value="{{ $buku->id_buku }}" {{ $buku->id_buku == $peminjamanPengembalian->buku_id ? 'selected' : '' }}>{{ $buku->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="member_id" class="col-sm-3 col-form-label">Member</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="member_id" name="member_id" required>
                            <option value="">Pilih Member</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id_member }}" {{ $member->id_member == $peminjamanPengembalian->member_id ? 'selected' : '' }}>{{ $member->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="tanggal_peminjaman" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" value="{{ $peminjamanPengembalian->tanggal_peminjaman }}" required>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('halaman.peminjaman') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </div>
                </div>

            </form>
        </div>
    </section>
    
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
