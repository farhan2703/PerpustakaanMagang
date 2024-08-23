@extends('layouts.layouts')

@section('main')

<section class="section">
  <div class="row">
    <div class="col-lg-8 offset-lg-2">
      <div class="card">
        <div class="card-header mb-3 bg-primary text-white">
          <h5>Detail Peminjaman Buku</h5>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">ID Peminjaman:</div>
            <div class="col-sm-8">{{ $peminjamanPengembalian->id }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">Judul Buku:</div>
            <div class="col-sm-8">{{ $peminjamanPengembalian->buku->judul }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">Nama Member:</div>
            <div class="col-sm-8">{{ $peminjamanPengembalian->member->nama }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">Tanggal Peminjaman:</div>
            <div class="col-sm-8">{{ $peminjamanPengembalian->created_at  }}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 font-weight-bold">Status:</div>
            <div class="col-sm-8">{{ $peminjamanPengembalian->status }}</div>
          </div>
        </div>
        <div class="card-footer text-end">
          <a href="{{ route('halaman.peminjaman') }}" class="btn btn-secondary">Cancel</a>
          <!-- Tombol Kembalikan Buku -->
          @if($peminjamanPengembalian->status == 'Dalam Peminjaman')
            <form action="{{ route('peminjaman.kembalikan', $peminjamanPengembalian->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('PUT')
              <button type="submit" class="btn btn-success">Kembalikan Buku</button>
            </form>
          @endif
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
