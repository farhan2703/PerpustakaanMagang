@extends('layouts.layouts')

@section('main')


<section class="section">
    
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Pengembalian buku</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif
                    
        <form action="{{ route('peminjamanmember.update', $peminjamanPengembalian->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Buku -->
            <div class="form-group row mb-3">
                <label for="buku_id" class="col-sm-3 col-form-label">Buku</label>
                <div class="col-sm-9">
                    <select class="form-control" id="buku_id" name="buku_id_disabled" disabled required>
                        <option  value="">Pilih Buku</option>
                        @foreach($bukus as $buku)
                            <option  value="{{ $buku->id_buku }}" {{ $buku->id_buku == $peminjamanPengembalian->buku_id ? 'selected' : '' }}>{{ $buku->judul }}</option>
                        @endforeach
                    </select>
                    <!-- Hidden input untuk mengirimkan value buku_id -->
                    <input type="hidden" name="buku_id" value="{{ $peminjamanPengembalian->buku_id }}">
                </div>
            </div>

            <!-- Member -->
            <div class="form-group row mb-3">
                <label for="member_id" class="col-sm-3 col-form-label">Member</label>
                <div class="col-sm-9">
                    <select class="form-control" id="id_member" name="member_id_disabled" disabled required>
                        <option value="">Pilih Member</option>
                        @foreach($member as $member)
                            <option value="{{ $member->id_member }}" {{ $member->id_member == $peminjamanPengembalian->member_id ? 'selected' : '' }}>{{ $member->nama }}</option>
                        @endforeach
                    </select>
                    <!-- Hidden input untuk mengirimkan value member_id -->
                    <input type="hidden" name="member_id" value="{{ $peminjamanPengembalian->member_id }}">
                </div>
            </div>

            <!-- Tanggal Peminjaman -->
            <div class="form-group row mb-3">
                <label for="tanggal_peminjaman" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman_disabled" value="{{ $peminjamanPengembalian->tanggal_peminjaman }}" disabled required>
                    <!-- Hidden input untuk mengirimkan value tanggal_peminjaman -->
                    <input type="hidden" name="tanggal_peminjaman" value="{{ $peminjamanPengembalian->tanggal_peminjaman }}">
                </div>
            </div>

            <!-- Status Pengembalian -->
            <div class="form-group row mb-3">
                <label for="status" class="col-sm-3 col-form-label">Status Pengembalian</label>
                <div class="col-sm-9">
                    <select class="form-control" id="status" name="status" required>
                        <option value="Dalam Peminjaman" {{ $peminjamanPengembalian->status_pengembalian == 'Dalam Peminjaman' ? 'selected' : '' }}>Dalam Peminjaman</option>
                        <option value="Telah Dikembalikan" {{ $peminjamanPengembalian->status_pengembalian == 'Telah Dikembalikan' ? 'selected' : '' }}>Telah Dikembalikan</option>
                    </select>
                </div>
            </div>

            <!-- Tanggal Pengembalian -->
            <div class="form-group row mb-3" id="tanggal_pengembalian_container">
                <label for="tanggal_pengembalian" class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="{{ $peminjamanPengembalian->tanggal_pengembalian }}">
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('halaman.peminjamanmember') }}" class="btn btn-secondary ms-2">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</section>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    
@endsection

@section('css')
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/font-awesome/css/all.min.css" rel="stylesheet">
<!-- Add any custom CSS here -->
@endsection

@section('js')
<!-- Add any custom JS here -->
@endsection

@section('scripts')
<!-- Add any additional scripts here -->
@endsection
