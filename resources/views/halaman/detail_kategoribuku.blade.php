@extends('layouts.layouts')

@section('main')


<section class="section">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header mb-3 bg-primary text-white">
                    <h5>Detail Kategori Buku: {{ $kategoriBuku->nama_kategori }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">ID Kategori:</div>
                        <div class="col-sm-8">{{ $kategoriBuku->id_kategori }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Nama Kategori:</div>
                        <div class="col-sm-8">{{ $kategoriBuku->nama_kategori }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Deskripsi:</div>
                        <div class="col-sm-8">{{ $kategoriBuku->deskripsi_kategori }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Tanggal Dibuat:</div>
                        <div class="col-sm-8">{{ $kategoriBuku->created_at }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Tanggal Diperbarui:</div>
                        <div class="col-sm-8">{{ $kategoriBuku->updated_at }}</div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('halaman.kategoribuku') }}" class="btn btn-secondary">Kembali ke Daftar Kategori Buku</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
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


