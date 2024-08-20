@extends('layouts.layouts')

@section('main')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Tambah Peminjaman Buku</h5>
                    </div>
                    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <form action="{{ route('peminjamanmember.store') }}" method="POST">
            @csrf
            <div class="form-group row mb-3">
                <label for="buku_id" class="col-sm-3 col-form-label">Buku</label>
                <div class="col-sm-9">
                    <select class="form-control" id="buku_id" name="buku_id" required>
                        <option value="">Pilih Buku</option>
                        @foreach($bukus as $buku)
                            <option value="{{ $buku->id_buku }}">{{ $buku->judul }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        
            <div class="form-group row mb-3">
                <label for="nama" class="col-sm-3 col-form-label">Member</label>
                <div class="col-sm-9">
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ Auth::user()->nama }}" disabled>
                    <input type="hidden" name="member_id" value="{{ Auth::user()->id_member }}">
                </div>
            </div>
        
            <div class="form-group row mb-3">
                <label for="tanggal_peminjaman" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
                </div>
            </div>
        
            <div class="form-group row mb-3">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('halaman.peminjamanmember') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </div>
        </form>
                    
    </div>
</section>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@endsection

@section('css')
<!-- Add any custom CSS here -->
@endsection

@section('js')
<!-- Add any custom JS here -->
@endsection

@section('scripts')
<!-- Add any additional scripts here -->
@endsection

