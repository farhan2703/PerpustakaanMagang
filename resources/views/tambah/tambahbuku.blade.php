@extends('layouts.layouts')

@section('main')
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Tambah Buku Baru</h5>
                    </div>
                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('halaman.buku.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control" id="judul" required>
                            </div>

                            <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" name="penulis" class="form-control" id="penulis" required>
                            </div>

                            <div class="mb-3">
                                <label for="penerbit" class="form-label">Penerbit</label>
                                <input type="text" name="penerbit" class="form-control" id="penerbit" required>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                                <input type="date" name="tahun_terbit" class="form-control" id="tahun_terbit" required>
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" id="stok" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-select" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('halaman.buku') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Tambah Buku</button>
                                
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
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
