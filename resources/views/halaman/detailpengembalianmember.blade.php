@extends('layouts.layouts')

@section('main')

<section class="section">
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h5>Detail Peminjaman Buku</h5>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">ID Peminjaman:</div>
            <div class="col-sm-8">{{ $peminjaman->id }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">Judul Buku:</div>
            <div class="col-sm-8">{{ $peminjaman->buku->judul }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">Nama Member:</div>
            <div class="col-sm-8">{{ $peminjaman->member->nama }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">Tanggal Peminjaman:</div>
            <div class="col-sm-8">{{ $peminjaman->tanggal_peminjaman }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">Tanggal Pengembalian:</div>
            <div class="col-sm-8">{{ $peminjaman->tanggal_pengembalian }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">Status:</div>
            <div class="col-sm-8">{{ $peminjaman->status }}</div>
          </div>
        </div>
        <div class="card-footer text-end">
          <a href="{{ route('halaman.pengembalianmember') }}" class="btn btn-secondary">Kembali ke Daftar Peminjaman</a>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
<script src="{{ asset('main.js') }}"></script>

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


