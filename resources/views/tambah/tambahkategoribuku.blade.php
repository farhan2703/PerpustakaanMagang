@extends('layouts.layouts')

@section('main')
<section class="section">

    <form action="{{ route('halaman.kategoribuku.store') }}" method="POST">
        @csrf
        <div class="form-group row mb-3">
            <label for="nama_kategori" class="col-sm-3 col-form-label">Nama Kategori</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="deskripsi_kategori" class="col-sm-3 col-form-label">Deskripsi Kategori</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="deskripsi_kategori" name="deskripsi_kategori" required></textarea>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="tanggal_dibuat" class="col-sm-3 col-form-label">Tanggal Dibuat</label>
            <div class="col-sm-9">
                <input type="date" class="form-control" id="tanggal_dibuat" name="tanggal_dibuat" required>
            </div>
        </div>

        <div class="form-group row mb-3">
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="{{ route('halaman.kategoribuku') }}" class="btn btn-secondary ms-2">Cancel</a>
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
