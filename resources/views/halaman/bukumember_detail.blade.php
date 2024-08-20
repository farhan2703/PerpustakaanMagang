@extends('layouts.layouts')

@section('main')

<section class="section">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Detail Buku: {{ $buku->judul }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">ID Buku:</div>
                        <div class="col-sm-8">{{ $buku->id_buku }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Judul Buku:</div>
                        <div class="col-sm-8">{{ $buku->judul }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Penulis:</div>
                        <div class="col-sm-8">{{ $buku->penulis }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Penerbit:</div>
                        <div class="col-sm-8">{{ $buku->penerbit }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Tahun Terbit:</div>
                        <div class="col-sm-8">{{ $buku->tahun_terbit }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Status Ketersediaan:</div>
                        <div class="col-sm-8">
                            @if($buku->stok > 0)
                              <span class="badge bg-success">{{ $buku->status_ketersediaan }}</span>
                          @else
                              <span class="badge bg-danger">Tidak tersedia</span>
                          @endif
                           
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Stok:</div>
                        <div class="col-sm-8">{{ $buku->stok }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Kategori:</div>
                        <div class="col-sm-8">{{ $buku->kategori }}</div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('halaman.bukumember') }}" class="btn btn-secondary">Kembali ke Daftar Buku</a>
                </div>
            </div>
        </div>
    </div>
</section>
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


