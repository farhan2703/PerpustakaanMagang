@extends('layouts.layouts')

@section('main')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="card">
                    <div class="card-header mb-3">
                        <h5 class="card-title">Edit Buku</h5>
                    </div>
                    <div class="card-body">

                        <!-- General Form Elements -->
                        <form action="{{ route('halaman.buku.update', $buku->id_buku) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-3">
                                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $buku->penerbit }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="tahun_terbit" class="col-sm-3 col-form-label">Tahun Terbit</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="stok" class="col-sm-3 col-form-label">Stok</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="stok" name="stok" value="{{ $buku->stok }}" min="0" required>
                                    <div id="stok-error" class="text-danger mt-2"></div>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-9">
                                    <select id="kategori" name="kategori" class="form-select" required>
                                        <option value="" disabled>Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->nama_kategori }}" {{ $buku->kategori == $kategori->nama_kategori ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                                <div class="col-sm-9 offset-sm-3">
                                    <a href="{{ route('halaman.buku') }}" class="btn btn-secondary ms-2">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            

                        </form>
                        <!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stokInput = document.getElementById('stok');
        const errorDiv = document.getElementById('stok-error');
        
        stokInput.addEventListener('input', function() {
            if (stokInput.value < 0) {
                errorDiv.textContent = 'Stok tidak boleh kurang dari 0.';
            } else {
                errorDiv.textContent = '';
            }
        });
    });
</script>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

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

