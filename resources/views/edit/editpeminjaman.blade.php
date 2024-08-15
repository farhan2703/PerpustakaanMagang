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
        <h1>Edit Peminjaman</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('halaman.peminjaman') }}">Peminjaman</a></li>
                <li class="breadcrumb-item active">Edit Peminjaman</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Edit Peminjaman</h5>
                        </div>
                        <div class="card-body">

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
                            @foreach($member as $member)
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
                    <label for="status_pengembalian" class="col-sm-3 col-form-label">Status Pengembalian</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="status_pengembalian" name="status_pengembalian" required>
                            <option value="">Pilih Status</option>
                            <option value="Dipinjam" {{ $peminjamanPengembalian->status_pengembalian == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="Telah dikembalikan" {{ $peminjamanPengembalian->status_pengembalian == 'Telah dikembalikan' ? 'selected' : '' }}>Telah dikembalikan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-3" id="tanggal_pengembalian_container">
                    <label for="tanggal_pengembalian" class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="{{ $peminjamanPengembalian->tanggal_pengembalian }}">
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

<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('status_pengembalian');
    const tanggalPengembalianContainer = document.getElementById('tanggal_pengembalian_container');
    const tanggalPengembalianInput = document.getElementById('tanggal_pengembalian');

    function toggleTanggalPengembalian() {
        if (statusSelect.value === 'Telah dikembalikan') {
            tanggalPengembalianContainer.style.display = 'block';
        } else {
            tanggalPengembalianContainer.style.display = 'none';
        }
    }

    // Initial check
    toggleTanggalPengembalian();

    // Update visibility when status changes
    statusSelect.addEventListener('change', toggleTanggalPengembalian);
});
</script>

</body>

</html>
