@extends('layouts.layouts')

@section('main')

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
                <div class="col-sm-9 offset-sm-3">
                    <a href="{{ route('halaman.kategoribuku') }}" class="btn btn-secondary ms-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>

        </form>
    </div></section>

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

