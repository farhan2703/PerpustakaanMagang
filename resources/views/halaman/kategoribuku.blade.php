@extends('layouts.layouts')

@section('main')

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tabel Kategori Buku</h5>
            <div class="text-end">
              <a href="{{ route('addkategoribuku') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                <i class="bi bi-plus"></i>
            </a>
          </div>
          <div class="card-body">

            <div class="table-responsive">
                <table id="kategoriTable" class="table table-bordered table-responsive-md">
                    <thead class="table-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Diperbarui</th>
                            <th>Status</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="kategori-table-url" value="{{ route('tableKategori') }}">
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

